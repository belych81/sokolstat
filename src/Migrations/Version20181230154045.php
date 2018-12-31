<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181230154045 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE nhl_season (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nhl_player (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, goal_reg INT NOT NULL, goal_play_off INT NOT NULL, goal_sum INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nhl_play_off (id INT AUTO_INCREMENT NOT NULL, season_id INT NOT NULL, team_id INT NOT NULL, player_id INT NOT NULL, goal INT NOT NULL, INDEX IDX_A62E16B84EC001D1 (season_id), INDEX IDX_A62E16B8296CD8AE (team_id), INDEX IDX_A62E16B899E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nhl_team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nhl_reg (id INT AUTO_INCREMENT NOT NULL, season_id INT NOT NULL, team_id INT NOT NULL, player_id INT NOT NULL, goal INT NOT NULL, INDEX IDX_F1C7376E4EC001D1 (season_id), INDEX IDX_F1C7376E296CD8AE (team_id), INDEX IDX_F1C7376E99E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nhl_play_off ADD CONSTRAINT FK_A62E16B84EC001D1 FOREIGN KEY (season_id) REFERENCES nhl_season (id)');
        $this->addSql('ALTER TABLE nhl_play_off ADD CONSTRAINT FK_A62E16B8296CD8AE FOREIGN KEY (team_id) REFERENCES nhl_team (id)');
        $this->addSql('ALTER TABLE nhl_play_off ADD CONSTRAINT FK_A62E16B899E6F5DF FOREIGN KEY (player_id) REFERENCES nhl_player (id)');
        $this->addSql('ALTER TABLE nhl_reg ADD CONSTRAINT FK_F1C7376E4EC001D1 FOREIGN KEY (season_id) REFERENCES nhl_season (id)');
        $this->addSql('ALTER TABLE nhl_reg ADD CONSTRAINT FK_F1C7376E296CD8AE FOREIGN KEY (team_id) REFERENCES nhl_team (id)');
        $this->addSql('ALTER TABLE nhl_reg ADD CONSTRAINT FK_F1C7376E99E6F5DF FOREIGN KEY (player_id) REFERENCES nhl_player (id)');
        $this->addSql('DROP TABLE cupplayer');
        $this->addSql('DROP TABLE ecplayer');
        $this->addSql('DROP TABLE ecsostav');
        $this->addSql('DROP TABLE ectable');
        $this->addSql('DROP TABLE fnlplayer');
        $this->addSql('DROP TABLE gamer');
        $this->addSql('DROP TABLE lchplayer');
        $this->addSql('DROP TABLE mundial');
        $this->addSql('DROP TABLE nationcup');
        $this->addSql('DROP TABLE nationsupercup');
        $this->addSql('DROP TABLE newmatches');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE nfl1617');
        $this->addSql('DROP TABLE playersteam');
        $this->addSql('DROP TABLE referee');
        $this->addSql('DROP TABLE rusplayer');
        $this->addSql('DROP TABLE russupercup');
        $this->addSql('DROP TABLE sbplayer');
        $this->addSql('DROP TABLE shiptable');
        $this->addSql('DROP TABLE sostav');
        $this->addSql('DROP TABLE supercupplayer');
        $this->addSql('DROP TABLE uefasupercup');
        $this->addSql('DROP TABLE vote');
        $this->addSql('DROP TABLE voteemail');
        $this->addSql('DROP TABLE voteplayer');
        $this->addSql('ALTER TABLE cup CHANGE season_id season_id INT NOT NULL, CHANGE stadia_id stadia_id INT NOT NULL, CHANGE team_id team_id INT NOT NULL, CHANGE team2_id team2_id INT NOT NULL, CHANGE bomb bomb VARCHAR(255) DEFAULT NULL, CHANGE game game VARCHAR(255) DEFAULT NULL, CHANGE game2 game2 VARCHAR(255) DEFAULT NULL, CHANGE data data DATETIME DEFAULT NULL, CHANGE status status TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE turnir DROP russianAlias');
        $this->addSql('ALTER TABLE tour CHANGE season_id season_id INT NOT NULL, CHANGE team_id team_id INT NOT NULL, CHANGE team2_id team2_id INT NOT NULL, CHANGE country_id country_id INT NOT NULL, CHANGE bomb bomb VARCHAR(255) DEFAULT NULL, CHANGE data data DATETIME DEFAULT NULL, CHANGE status status TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE team CHANGE country_id country_id INT NOT NULL');
        $this->addSql('ALTER TABLE shipplayer CHANGE season_id season_id INT NOT NULL, CHANGE team_id team_id INT NOT NULL, CHANGE player_id player_id INT NOT NULL');
        $this->addSql('ALTER TABLE rfplmatch CHANGE season_id season_id INT NOT NULL, CHANGE team_id team_id INT NOT NULL');
        $this->addSql('ALTER TABLE eurocup CHANGE season_id season_id INT NOT NULL, CHANGE team_id team_id INT NOT NULL, CHANGE team2_id team2_id INT NOT NULL, CHANGE turnir_id turnir_id INT NOT NULL, CHANGE stadia_id stadia_id INT NOT NULL');
        $this->addSql('ALTER TABLE player CHANGE amplua_id amplua_id INT NOT NULL, CHANGE country_id country_id INT NOT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE country CHANGE translit translit VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nhl_play_off DROP FOREIGN KEY FK_A62E16B84EC001D1');
        $this->addSql('ALTER TABLE nhl_reg DROP FOREIGN KEY FK_F1C7376E4EC001D1');
        $this->addSql('ALTER TABLE nhl_play_off DROP FOREIGN KEY FK_A62E16B899E6F5DF');
        $this->addSql('ALTER TABLE nhl_reg DROP FOREIGN KEY FK_F1C7376E99E6F5DF');
        $this->addSql('ALTER TABLE nhl_play_off DROP FOREIGN KEY FK_A62E16B8296CD8AE');
        $this->addSql('ALTER TABLE nhl_reg DROP FOREIGN KEY FK_F1C7376E296CD8AE');
        $this->addSql('CREATE TABLE cupplayer (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, team_id INT DEFAULT NULL, player_id INT DEFAULT NULL, game INT NOT NULL, goal INT NOT NULL, INDEX IDX_A2E43DD6296CD8AE (team_id), INDEX IDX_A2E43DD64EC001D1 (season_id), INDEX IDX_A2E43DD699E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ecplayer (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, team_id INT DEFAULT NULL, player_id INT DEFAULT NULL, turnir_id INT DEFAULT NULL, game INT NOT NULL, goal INT NOT NULL, INDEX IDX_6EACFC08296CD8AE (team_id), INDEX IDX_6EACFC082AEBD7A2 (turnir_id), INDEX IDX_6EACFC084EC001D1 (season_id), INDEX IDX_6EACFC0899E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ecsostav (id INT AUTO_INCREMENT NOT NULL, eurocup_id INT DEFAULT NULL, team VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, team2 VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX UNIQ_3E51F92CB09625CC (eurocup_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ectable (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, team_id INT DEFAULT NULL, stadia_id INT DEFAULT NULL, turnir_id INT DEFAULT NULL, wins INT NOT NULL, nich INT NOT NULL, porazh INT NOT NULL, mz INT NOT NULL, mp INT NOT NULL, score INT NOT NULL, INDEX IDX_FA89B993296CD8AE (team_id), INDEX IDX_FA89B9932AEBD7A2 (turnir_id), INDEX IDX_FA89B9934EC001D1 (season_id), INDEX IDX_FA89B9933721E7B1 (stadia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE fnlplayer (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, team_id INT DEFAULT NULL, player_id INT DEFAULT NULL, game INT NOT NULL, goal INT NOT NULL, INDEX IDX_69DCA35E296CD8AE (team_id), INDEX IDX_69DCA35E4EC001D1 (season_id), INDEX IDX_69DCA35E99E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE gamer (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, team_id INT DEFAULT NULL, player_id INT DEFAULT NULL, game INT NOT NULL, goal INT NOT NULL, INDEX IDX_88241BA7296CD8AE (team_id), INDEX IDX_88241BA799E6F5DF (player_id), INDEX IDX_88241BA74EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE lchplayer (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, team_id INT DEFAULT NULL, player_id INT DEFAULT NULL, game INT NOT NULL, goal INT NOT NULL, INDEX IDX_93B81802296CD8AE (team_id), INDEX IDX_93B8180299E6F5DF (player_id), INDEX IDX_93B818024EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mundial (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, country_id INT DEFAULT NULL, country2_id INT DEFAULT NULL, turnir_id INT DEFAULT NULL, stadia_id INT DEFAULT NULL, city_id INT DEFAULT NULL, referee_id INT DEFAULT NULL, goal VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, score VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, game VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, game2 VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, penalty VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, data DATETIME NOT NULL, zriteli INT NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_C140406B4A087CA2 (referee_id), INDEX IDX_C140406B4EC001D1 (season_id), INDEX IDX_C140406B9425DC7F (country2_id), INDEX IDX_C140406B3721E7B1 (stadia_id), INDEX IDX_C140406BF92F3E70 (country_id), INDEX IDX_C140406B2AEBD7A2 (turnir_id), INDEX IDX_C140406B8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE nationcup (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, country_id INT DEFAULT NULL, stadia_id INT DEFAULT NULL, team_id INT DEFAULT NULL, team2_id INT DEFAULT NULL, bomb VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, score VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, data DATETIME NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_D172AD4D4EC001D1 (season_id), INDEX IDX_D172AD4D3721E7B1 (stadia_id), INDEX IDX_D172AD4DF59E604A (team2_id), INDEX IDX_D172AD4DF92F3E70 (country_id), INDEX IDX_D172AD4D296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE nationsupercup (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, team_id INT DEFAULT NULL, country_id INT DEFAULT NULL, team2_id INT DEFAULT NULL, goal VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, score VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, data DATETIME NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_B295CAAA4EC001D1 (season_id), INDEX IDX_B295CAAAF92F3E70 (country_id), INDEX IDX_B295CAAA296CD8AE (team_id), INDEX IDX_B295CAAAF59E604A (team2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE newmatches (id INT AUTO_INCREMENT NOT NULL, data DATE NOT NULL, time TIME NOT NULL, team VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, team2 VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, score VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, status TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, data DATETIME NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, text LONGTEXT NOT NULL COLLATE utf8_unicode_ci, translit VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE nfl1617 (id INT AUTO_INCREMENT NOT NULL, team VARCHAR(255) NOT NULL COLLATE utf8_general_ci, conf INT NOT NULL, divis INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE playersteam (id INT AUTO_INCREMENT NOT NULL, team_id INT DEFAULT NULL, player_id INT DEFAULT NULL, game INT NOT NULL, goal INT NOT NULL, INDEX IDX_62CB3429296CD8AE (team_id), INDEX IDX_62CB342999E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE referee (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_D60FB342F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rusplayer (id INT AUTO_INCREMENT NOT NULL, player_id INT DEFAULT NULL, game INT NOT NULL, goal INT NOT NULL, total_game INT NOT NULL, total_goal INT NOT NULL, fnl_game INT NOT NULL, fnl_goal INT NOT NULL, sb_game INT NOT NULL, sb_goal INT NOT NULL, INDEX IDX_28B7717999E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE russupercup (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, team_id INT DEFAULT NULL, team2_id INT DEFAULT NULL, goal VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, score VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, game VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, game2 VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_5B1296F04EC001D1 (season_id), INDEX IDX_5B1296F0F59E604A (team2_id), INDEX IDX_5B1296F0296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sbplayer (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, player_id INT DEFAULT NULL, game INT NOT NULL, goal INT NOT NULL, INDEX IDX_720FCF104EC001D1 (season_id), INDEX IDX_720FCF1099E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE shiptable (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, team_id INT DEFAULT NULL, country_id INT DEFAULT NULL, wins INT NOT NULL, nich INT NOT NULL, porazh INT NOT NULL, mz INT NOT NULL, mp INT NOT NULL, score INT NOT NULL, INDEX IDX_92E2C1C4EC001D1 (season_id), INDEX IDX_92E2C1CF92F3E70 (country_id), INDEX IDX_92E2C1C296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sostav (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, country_id INT DEFAULT NULL, team_id INT DEFAULT NULL, player_id INT DEFAULT NULL, game INT NOT NULL, goal INT NOT NULL, number INT NOT NULL, INDEX IDX_C8E47F414EC001D1 (season_id), INDEX IDX_C8E47F41296CD8AE (team_id), INDEX IDX_C8E47F41F92F3E70 (country_id), INDEX IDX_C8E47F4199E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE supercupplayer (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, team_id INT DEFAULT NULL, player_id INT DEFAULT NULL, goal INT NOT NULL, INDEX IDX_53F6E79D4EC001D1 (season_id), INDEX IDX_53F6E79D99E6F5DF (player_id), INDEX IDX_53F6E79D296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE uefasupercup (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, team_id INT DEFAULT NULL, team2_id INT DEFAULT NULL, goal VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, score VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, game VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, game2 VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_3ECB96C34EC001D1 (season_id), INDEX IDX_3ECB96C3F59E604A (team2_id), INDEX IDX_3ECB96C3296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vote (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, date DATE NOT NULL, voted INT NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE voteemail (id INT AUTO_INCREMENT NOT NULL, vote_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_DD5FD5E72DCDAFC (vote_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE voteplayer (id INT AUTO_INCREMENT NOT NULL, player_id INT DEFAULT NULL, vote_id INT DEFAULT NULL, sum INT NOT NULL, INDEX IDX_4348F43299E6F5DF (player_id), INDEX IDX_4348F43272DCDAFC (vote_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cupplayer ADD CONSTRAINT FK_A2E43DD6296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE cupplayer ADD CONSTRAINT FK_A2E43DD64EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE cupplayer ADD CONSTRAINT FK_A2E43DD699E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE ecplayer ADD CONSTRAINT FK_6EACFC08296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE ecplayer ADD CONSTRAINT FK_6EACFC082AEBD7A2 FOREIGN KEY (turnir_id) REFERENCES turnir (id)');
        $this->addSql('ALTER TABLE ecplayer ADD CONSTRAINT FK_6EACFC084EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE ecplayer ADD CONSTRAINT FK_6EACFC0899E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE ecsostav ADD CONSTRAINT FK_3E51F92CB09625CC FOREIGN KEY (eurocup_id) REFERENCES eurocup (id)');
        $this->addSql('ALTER TABLE ectable ADD CONSTRAINT FK_FA89B993296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE ectable ADD CONSTRAINT FK_FA89B9932AEBD7A2 FOREIGN KEY (turnir_id) REFERENCES turnir (id)');
        $this->addSql('ALTER TABLE ectable ADD CONSTRAINT FK_FA89B9933721E7B1 FOREIGN KEY (stadia_id) REFERENCES stadia (id)');
        $this->addSql('ALTER TABLE ectable ADD CONSTRAINT FK_FA89B9934EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE fnlplayer ADD CONSTRAINT FK_69DCA35E296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE fnlplayer ADD CONSTRAINT FK_69DCA35E4EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE fnlplayer ADD CONSTRAINT FK_69DCA35E99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE gamer ADD CONSTRAINT FK_88241BA7296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE gamer ADD CONSTRAINT FK_88241BA74EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE gamer ADD CONSTRAINT FK_88241BA799E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE lchplayer ADD CONSTRAINT FK_93B81802296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE lchplayer ADD CONSTRAINT FK_93B818024EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE lchplayer ADD CONSTRAINT FK_93B8180299E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE mundial ADD CONSTRAINT FK_C140406B2AEBD7A2 FOREIGN KEY (turnir_id) REFERENCES turnir (id)');
        $this->addSql('ALTER TABLE mundial ADD CONSTRAINT FK_C140406B3721E7B1 FOREIGN KEY (stadia_id) REFERENCES stadia (id)');
        $this->addSql('ALTER TABLE mundial ADD CONSTRAINT FK_C140406B4A087CA2 FOREIGN KEY (referee_id) REFERENCES referee (id)');
        $this->addSql('ALTER TABLE mundial ADD CONSTRAINT FK_C140406B4EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE mundial ADD CONSTRAINT FK_C140406B8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE mundial ADD CONSTRAINT FK_C140406B9425DC7F FOREIGN KEY (country2_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE mundial ADD CONSTRAINT FK_C140406BF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE nationcup ADD CONSTRAINT FK_D172AD4D296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE nationcup ADD CONSTRAINT FK_D172AD4D3721E7B1 FOREIGN KEY (stadia_id) REFERENCES stadia (id)');
        $this->addSql('ALTER TABLE nationcup ADD CONSTRAINT FK_D172AD4D4EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE nationcup ADD CONSTRAINT FK_D172AD4DF59E604A FOREIGN KEY (team2_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE nationcup ADD CONSTRAINT FK_D172AD4DF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE nationsupercup ADD CONSTRAINT FK_B295CAAA296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE nationsupercup ADD CONSTRAINT FK_B295CAAA4EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE nationsupercup ADD CONSTRAINT FK_B295CAAAF59E604A FOREIGN KEY (team2_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE nationsupercup ADD CONSTRAINT FK_B295CAAAF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE playersteam ADD CONSTRAINT FK_62CB3429296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE playersteam ADD CONSTRAINT FK_62CB342999E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE referee ADD CONSTRAINT FK_D60FB342F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE rusplayer ADD CONSTRAINT FK_28B7717999E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE russupercup ADD CONSTRAINT FK_5B1296F0296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE russupercup ADD CONSTRAINT FK_5B1296F04EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE russupercup ADD CONSTRAINT FK_5B1296F0F59E604A FOREIGN KEY (team2_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE sbplayer ADD CONSTRAINT FK_720FCF104EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE sbplayer ADD CONSTRAINT FK_720FCF1099E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE shiptable ADD CONSTRAINT FK_92E2C1C296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE shiptable ADD CONSTRAINT FK_92E2C1C4EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE shiptable ADD CONSTRAINT FK_92E2C1CF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE sostav ADD CONSTRAINT FK_C8E47F41296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE sostav ADD CONSTRAINT FK_C8E47F414EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE sostav ADD CONSTRAINT FK_C8E47F4199E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE sostav ADD CONSTRAINT FK_C8E47F41F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE supercupplayer ADD CONSTRAINT FK_53F6E79D296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE supercupplayer ADD CONSTRAINT FK_53F6E79D4EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE supercupplayer ADD CONSTRAINT FK_53F6E79D99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE uefasupercup ADD CONSTRAINT FK_3ECB96C3296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE uefasupercup ADD CONSTRAINT FK_3ECB96C34EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE uefasupercup ADD CONSTRAINT FK_3ECB96C3F59E604A FOREIGN KEY (team2_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE voteemail ADD CONSTRAINT FK_DD5FD5E72DCDAFC FOREIGN KEY (vote_id) REFERENCES vote (id)');
        $this->addSql('ALTER TABLE voteplayer ADD CONSTRAINT FK_4348F43272DCDAFC FOREIGN KEY (vote_id) REFERENCES vote (id)');
        $this->addSql('ALTER TABLE voteplayer ADD CONSTRAINT FK_4348F43299E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('DROP TABLE nhl_season');
        $this->addSql('DROP TABLE nhl_player');
        $this->addSql('DROP TABLE nhl_play_off');
        $this->addSql('DROP TABLE nhl_team');
        $this->addSql('DROP TABLE nhl_reg');
        $this->addSql('ALTER TABLE country CHANGE translit translit VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE cup CHANGE season_id season_id INT DEFAULT NULL, CHANGE stadia_id stadia_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL, CHANGE team2_id team2_id INT DEFAULT NULL, CHANGE bomb bomb VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE game game VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE game2 game2 VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE data data DATETIME NOT NULL, CHANGE status status TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE eurocup CHANGE season_id season_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL, CHANGE team2_id team2_id INT DEFAULT NULL, CHANGE stadia_id stadia_id INT DEFAULT NULL, CHANGE turnir_id turnir_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player CHANGE amplua_id amplua_id INT DEFAULT NULL, CHANGE country_id country_id INT DEFAULT NULL, CHANGE image image VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE rfplmatch CHANGE season_id season_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shipplayer CHANGE season_id season_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL, CHANGE player_id player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team CHANGE country_id country_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tour CHANGE season_id season_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL, CHANGE team2_id team2_id INT DEFAULT NULL, CHANGE country_id country_id INT DEFAULT NULL, CHANGE bomb bomb VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE data data DATETIME NOT NULL, CHANGE status status TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE turnir ADD russianAlias VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
