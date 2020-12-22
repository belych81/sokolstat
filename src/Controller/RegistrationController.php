<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\Functions;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private $emailVerifier;
    private $functions;

    public function __construct(EmailVerifier $emailVerifier, Functions $functions)
    {
        $this->emailVerifier = $emailVerifier;
        $this->functions = $functions;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $signedUrl = $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('admin@sokolstat.ru', 'SokolStat'))
                    ->to($user->getEmail())
                    ->subject('Подтверждение аккаунта')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            if($token = $this->functions->getParamUrl('token', $signedUrl)){
                $user->setToken($token);
                $entityManager->persist($user);
                $entityManager->flush();
            }

            return $this->render('registration/register.html.twig', [
                'confirmMessage' => 'На указанный адрес электронной почты отправлено письмо.
                    Для завершения регистрации перейдите, пожалуйста, по ссылке, указанной в нём.'
            ]);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request): Response
    {
        //$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if($token = $this->functions->getParamUrl('token', $request->getUri())){
            $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['token' => $token]);

            if($user instanceof User)
            {
                $this->addFlash('verify_email_error', $user->getId());
                $this->addFlash('verify_email_error', $user->getEmail());
                // validate email confirmation link, sets User::isVerified=true and persists
                try {
                    $this->emailVerifier->handleEmailConfirmation($request, $user);
                } catch (VerifyEmailExceptionInterface $exception) {
                    $this->addFlash('verify_email_error', $exception->getReason());
                    return $this->redirectToRoute('app_register');
                }

                return $this->redirectToRoute('app_verify_email_success');
            }
        }

        $this->addFlash('verify_email_error', 'Ошибка! Пользователь не найден.');

        return $this->redirectToRoute('app_register');

    }

    /**
     * @Route("/register/success", name="app_verify_email_success")
     */
    public function verifySuccess()
    {
        $this->addFlash('success', 'Ваш аккаунт успешно подтвержден.');

        return $this->render('registration/verify_success.html.twig');
    }
}
