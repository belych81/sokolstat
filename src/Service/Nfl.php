<?php
namespace App\Service;

use App\Entity\NhlTeam;
use App\Entity\NflMatch;
use App\Entity\Seasons;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;


class Nfl
{

    private $em;
    private $teamIds;
    private $slugger;

    public function __construct(EntityManagerInterface $em, SluggerInterface $slugger)
    {
        $this->em = $em;
        $this->slugger = $slugger;
    }
    
    public function getMatchesByFile(string $pathfile) :array
    {
        $lines = file($pathfile);
        $matches = [];
        foreach($lines as $line){
            $matches[] = explode(" - ", mb_strtoupper(trim($line)));
            
        }
        //var_dump($matches);
        return $matches;
    }

    public function parseMatches(array $matches, string $season)
    {
        foreach($matches as $match){

            if(key_exists($match[0], $this->teamIds) && $this->teamIds[$match[0]]){
                $id1 = $this->teamIds[$match[0]];
            } else {
                $id1 = $this->addTeam($match[0]);
                $this->teamIds[$match[0]] = $id1;
            }
            if(key_exists($match[1], $this->teamIds) && $this->teamIds[$match[1]]){
                $id2 = $this->teamIds[$match[1]];
            } else {
                $id2 = $this->addTeam($match[1]);
                $this->teamIds[$match[1]] = $id2;
            }
            if($id1 && $id2){
                $this->addMatch($id1, $id2, $season);
            }
        }
    }

    public function setTeamIds()
    {
        $arr = $this->em->getRepository(NhlTeam::class)->getTeams();
        foreach($arr as $row){
            $this->teamIds[$row->getName()] = $row->getId();
        }
    }

    public function addTeam(string $name)
    {
        $entity  = new NhlTeam();
        $entity->setName($name);

        $slug = $this->slugger->slug($name)->lower();
        $entity->setTranslit($slug);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity->getId();
    }

    public function addMatch(int $id1, int $id2, string $season)
    {
        $entity  = new NflMatch();
        $team1 = $this->em->getRepository(NhlTeam::class)->findOneById($id1);
        $team2 = $this->em->getRepository(NhlTeam::class)->findOneById($id2);
        $entity->setTeam($team1);
        $entity->setTeam2($team2);
        $year = $this->em->getRepository(Seasons::class)->findOneByName($season);
        $entity->setSeason($year);

        $this->em->persist($entity);
        $this->em->flush();
    }

}