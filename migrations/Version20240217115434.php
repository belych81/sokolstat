<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240217115434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nfl_match (id INT AUTO_INCREMENT NOT NULL, team_id INT DEFAULT NULL, team2_id INT NOT NULL, season_id INT DEFAULT NULL, status TINYINT(1) NOT NULL, INDEX IDX_699B490F296CD8AE (team_id), INDEX IDX_699B490FF59E604A (team2_id), INDEX IDX_699B490F4EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        $this->addSql('ALTER TABLE nfl_match ADD CONSTRAINT FK_699B490F296CD8AE FOREIGN KEY (team_id) REFERENCES nhl_team (id)');
        $this->addSql('ALTER TABLE nfl_match ADD CONSTRAINT FK_699B490FF59E604A FOREIGN KEY (team2_id) REFERENCES nhl_team (id)');
        $this->addSql('ALTER TABLE nfl_match ADD CONSTRAINT FK_699B490F4EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE acl_classes (id INT UNSIGNED AUTO_INCREMENT NOT NULL, class_type VARCHAR(200) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, UNIQUE INDEX UNIQ_69DD750638A36066 (class_type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE acl_entries (id INT UNSIGNED AUTO_INCREMENT NOT NULL, class_id INT UNSIGNED NOT NULL, object_identity_id INT UNSIGNED DEFAULT NULL, security_identity_id INT UNSIGNED NOT NULL, field_name VARCHAR(50) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, ace_order SMALLINT UNSIGNED NOT NULL, mask INT NOT NULL, granting TINYINT(1) NOT NULL, granting_strategy VARCHAR(30) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, audit_success TINYINT(1) NOT NULL, audit_failure TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4 (class_id, object_identity_id, field_name, ace_order), INDEX IDX_46C8B806EA000B103D9AB4A6DF9183C9 (class_id, object_identity_id, security_identity_id), INDEX IDX_46C8B806EA000B10 (class_id), INDEX IDX_46C8B8063D9AB4A6 (object_identity_id), INDEX IDX_46C8B806DF9183C9 (security_identity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE acl_object_identities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, parent_object_identity_id INT UNSIGNED DEFAULT NULL, class_id INT UNSIGNED NOT NULL, object_identifier VARCHAR(100) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, entries_inheriting TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_9407E5494B12AD6EA000B10 (object_identifier, class_id), INDEX IDX_9407E54977FA751A (parent_object_identity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE acl_object_identity_ancestors (object_identity_id INT UNSIGNED NOT NULL, ancestor_id INT UNSIGNED NOT NULL, INDEX IDX_825DE2993D9AB4A6 (object_identity_id), INDEX IDX_825DE299C671CEA1 (ancestor_id), PRIMARY KEY(object_identity_id, ancestor_id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE acl_security_identities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, identifier VARCHAR(200) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, username TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8835EE78772E836AF85E0677 (identifier, username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE fos_user_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, roles LONGTEXT CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci` COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_583D1F3E5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE fos_user_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, username_canonical VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, email_canonical VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci` COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, date_of_birth DATETIME DEFAULT NULL, firstname VARCHAR(64) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, lastname VARCHAR(64) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, website VARCHAR(64) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, biography VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, gender VARCHAR(1) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, locale VARCHAR(8) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, timezone VARCHAR(64) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, phone VARCHAR(64) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, facebook_uid VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, facebook_name VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, facebook_data JSON CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, twitter_uid VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, twitter_name VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, twitter_data JSON CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, gplus_uid VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, gplus_name VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, gplus_data JSON CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, token VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, two_step_code VARCHAR(255) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`, UNIQUE INDEX UNIQ_C560D76192FC23A8 (username_canonical), UNIQUE INDEX UNIQ_C560D761A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE fos_user_user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_B3C77447A76ED395 (user_id), INDEX IDX_B3C77447FE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE nfl1617 (id INT AUTO_INCREMENT NOT NULL, team VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, conf INT NOT NULL, divis INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_swedish_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vote (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, date DATE NOT NULL, voted INT NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE voteemail (id INT AUTO_INCREMENT NOT NULL, vote_id INT DEFAULT NULL, email VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_unicode_ci`, INDEX IDX_DD5FD5E72DCDAFC (vote_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE voteplayer (id INT AUTO_INCREMENT NOT NULL, player_id INT DEFAULT NULL, vote_id INT DEFAULT NULL, sum INT NOT NULL, INDEX IDX_4348F43299E6F5DF (player_id), INDEX IDX_4348F43272DCDAFC (vote_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806EA000B10 FOREIGN KEY (class_id) REFERENCES acl_classes (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806DF9183C9 FOREIGN KEY (security_identity_id) REFERENCES acl_security_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B8063D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_object_identities ADD CONSTRAINT FK_9407E54977FA751A FOREIGN KEY (parent_object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE299C671CEA1 FOREIGN KEY (ancestor_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE2993D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447FE54D947 FOREIGN KEY (group_id) REFERENCES fos_user_group (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user_user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voteemail ADD CONSTRAINT FK_DD5FD5E72DCDAFC FOREIGN KEY (vote_id) REFERENCES vote (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE voteplayer ADD CONSTRAINT FK_4348F43299E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE voteplayer ADD CONSTRAINT FK_4348F43272DCDAFC FOREIGN KEY (vote_id) REFERENCES vote (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE cup DROP FOREIGN KEY FK_B79D50E44EC001D1');
        $this->addSql('ALTER TABLE cup DROP FOREIGN KEY FK_B79D50E43721E7B1');
        $this->addSql('ALTER TABLE cup DROP FOREIGN KEY FK_B79D50E4296CD8AE');
        $this->addSql('ALTER TABLE cup DROP FOREIGN KEY FK_B79D50E4F59E604A');
        $this->addSql('ALTER TABLE cup_league DROP FOREIGN KEY FK_95D53BEA4EC001D1');
        $this->addSql('ALTER TABLE cup_league DROP FOREIGN KEY FK_95D53BEA3721E7B1');
        $this->addSql('ALTER TABLE cup_league DROP FOREIGN KEY FK_95D53BEA296CD8AE');
        $this->addSql('ALTER TABLE cup_league DROP FOREIGN KEY FK_95D53BEAF59E604A');
        $this->addSql('ALTER TABLE ecsostav DROP FOREIGN KEY FK_3E51F92CB09625CC');
        $this->addSql('ALTER TABLE ecsostav DROP FOREIGN KEY FK_3E51F92C8BAC62AF');
        $this->addSql('ALTER TABLE ecsostav DROP FOREIGN KEY FK_3E51F92C4A087CA2');
        $this->addSql('ALTER TABLE eurocup DROP FOREIGN KEY FK_B786FD424EC001D1');
        $this->addSql('ALTER TABLE eurocup DROP FOREIGN KEY FK_B786FD42296CD8AE');
        $this->addSql('ALTER TABLE eurocup DROP FOREIGN KEY FK_B786FD42F59E604A');
        $this->addSql('ALTER TABLE eurocup DROP FOREIGN KEY FK_B786FD423721E7B1');
        $this->addSql('ALTER TABLE eurocup DROP FOREIGN KEY FK_B786FD422AEBD7A2');
        $this->addSql('ALTER TABLE nation_cup DROP FOREIGN KEY FK_559ABDAF4EC001D1');
        $this->addSql('ALTER TABLE nation_cup DROP FOREIGN KEY FK_559ABDAF296CD8AE');
        $this->addSql('ALTER TABLE nation_cup DROP FOREIGN KEY FK_559ABDAFF59E604A');
        $this->addSql('ALTER TABLE nation_cup DROP FOREIGN KEY FK_559ABDAFF92F3E70');
        $this->addSql('ALTER TABLE nation_cup DROP FOREIGN KEY FK_559ABDAF3721E7B1');
        $this->addSql('ALTER TABLE nation_supercup DROP FOREIGN KEY FK_4886D5DD4EC001D1');
        $this->addSql('ALTER TABLE nation_supercup DROP FOREIGN KEY FK_4886D5DD296CD8AE');
        $this->addSql('ALTER TABLE nation_supercup DROP FOREIGN KEY FK_4886D5DDF92F3E70');
        $this->addSql('ALTER TABLE nation_supercup DROP FOREIGN KEY FK_4886D5DDF59E604A');
        $this->addSql('ALTER TABLE newsdb DROP FOREIGN KEY FK_D09CD74FB5A459A0');
        $this->addSql('ALTER TABLE nfl_match DROP FOREIGN KEY FK_699B490F296CD8AE');
        $this->addSql('ALTER TABLE nfl_match DROP FOREIGN KEY FK_699B490FF59E604A');
        $this->addSql('ALTER TABLE nfl_match DROP FOREIGN KEY FK_699B490F4EC001D1');
        $this->addSql('ALTER TABLE nhl_play_off DROP FOREIGN KEY FK_A62E16B84EC001D1');
        $this->addSql('ALTER TABLE nhl_play_off DROP FOREIGN KEY FK_A62E16B8296CD8AE');
        $this->addSql('ALTER TABLE nhl_play_off DROP FOREIGN KEY FK_A62E16B899E6F5DF');
        $this->addSql('ALTER TABLE rfplmatch DROP FOREIGN KEY FK_1FF7BD34EC001D1');
        $this->addSql('ALTER TABLE rfplmatch DROP FOREIGN KEY FK_1FF7BD3296CD8AE');
        $this->addSql('ALTER TABLE rfplmatch DROP FOREIGN KEY FK_1FF7BD3F59E604A');
        $this->addSql('ALTER TABLE rfplmatch DROP FOREIGN KEY FK_1FF7BD399E6F5DF');
        $this->addSql('ALTER TABLE rfplmatch DROP FOREIGN KEY FK_1FF7BD3D22CABCD');
        $this->addSql('ALTER TABLE rfplmatch DROP FOREIGN KEY FK_1FF7BD38BAC62AF');
        $this->addSql('ALTER TABLE rfplmatch DROP FOREIGN KEY FK_1FF7BD34A087CA2');
        $this->addSql('ALTER TABLE rus_supercup DROP FOREIGN KEY FK_C3D1EA6B4EC001D1');
        $this->addSql('ALTER TABLE rus_supercup DROP FOREIGN KEY FK_C3D1EA6B296CD8AE');
        $this->addSql('ALTER TABLE rus_supercup DROP FOREIGN KEY FK_C3D1EA6BF59E604A');
        $this->addSql('ALTER TABLE tour DROP FOREIGN KEY FK_6AD1F9694EC001D1');
        $this->addSql('ALTER TABLE tour DROP FOREIGN KEY FK_6AD1F969296CD8AE');
        $this->addSql('ALTER TABLE tour DROP FOREIGN KEY FK_6AD1F969F59E604A');
        $this->addSql('ALTER TABLE tour DROP FOREIGN KEY FK_6AD1F969F92F3E70');
        $this->addSql('ALTER TABLE uefa_supercup DROP FOREIGN KEY FK_7C64527D4EC001D1');
        $this->addSql('ALTER TABLE uefa_supercup DROP FOREIGN KEY FK_7C64527D296CD8AE');
        $this->addSql('ALTER TABLE uefa_supercup DROP FOREIGN KEY FK_7C64527DF59E604A');
        $this->addSql('DROP TABLE cup');
        $this->addSql('DROP TABLE cup_league');
        $this->addSql('DROP TABLE ecsostav');
        $this->addSql('DROP TABLE eurocup');
        $this->addSql('DROP TABLE nation_cup');
        $this->addSql('DROP TABLE nation_supercup');
        $this->addSql('DROP TABLE newsdb');
        $this->addSql('DROP TABLE newspaper');
        $this->addSql('DROP TABLE nfl_match');
        $this->addSql('DROP TABLE nhl_play_off');
        $this->addSql('DROP TABLE nhl_season');
        $this->addSql('DROP TABLE rfplmatch');
        $this->addSql('DROP TABLE rus_supercup');
        $this->addSql('DROP TABLE tour');
        $this->addSql('DROP TABLE uefa_supercup');
        $this->addSql('ALTER TABLE country CHANGE translit translit VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE cupplayer CHANGE season_id season_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL, CHANGE player_id player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ecplayer CHANGE team_id team_id INT DEFAULT NULL, CHANGE player_id player_id INT DEFAULT NULL, CHANGE turnir_id turnir_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ectable CHANGE season_id season_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL, CHANGE stadia_id stadia_id INT DEFAULT NULL, CHANGE turnir_id turnir_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fnlplayer CHANGE season_id season_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL, CHANGE player_id player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C3721E7B1');
        $this->addSql('ALTER TABLE gamers CHANGE season_id season_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL, CHANGE player_id player_id INT DEFAULT NULL, CHANGE totalgame totalgame INT DEFAULT 0 NOT NULL, CHANGE totalgoal totalgoal INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE gamers RENAME INDEX idx_5334dd5b4ec001d1 TO IDX_88241BA74EC001D1');
        $this->addSql('ALTER TABLE gamers RENAME INDEX idx_5334dd5b296cd8ae TO IDX_88241BA7296CD8AE');
        $this->addSql('ALTER TABLE gamers RENAME INDEX idx_5334dd5b99e6f5df TO IDX_88241BA799E6F5DF');
        $this->addSql('ALTER TABLE lchplayer CHANGE season_id season_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL, CHANGE player_id player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mundial CHANGE season_id season_id INT DEFAULT NULL, CHANGE country_id country_id INT DEFAULT NULL, CHANGE country2_id country2_id INT DEFAULT NULL, CHANGE turnir_id turnir_id INT DEFAULT NULL, CHANGE stadia_id stadia_id INT DEFAULT NULL, CHANGE city_id city_id INT DEFAULT NULL, CHANGE referee_id referee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mundial_table DROP FOREIGN KEY FK_4DA860402AEBD7A2');
        $this->addSql('ALTER TABLE mundial_table DROP FOREIGN KEY FK_4DA86040F92F3E70');
        $this->addSql('ALTER TABLE mundial_table DROP FOREIGN KEY FK_4DA860403721E7B1');
        $this->addSql('DROP INDEX IDX_4DA860402AEBD7A2 ON mundial_table');
        $this->addSql('DROP INDEX IDX_4DA86040F92F3E70 ON mundial_table');
        $this->addSql('DROP INDEX IDX_4DA860403721E7B1 ON mundial_table');
        $this->addSql('ALTER TABLE mundial_table CHANGE turnir_id turnir_id INT NOT NULL, CHANGE country_id country_id INT NOT NULL, CHANGE stadia_id stadia_id INT NOT NULL');
        $this->addSql('ALTER TABLE nhl_conf CHANGE name name VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`');
        $this->addSql('ALTER TABLE nhl_division CHANGE conf_id conf_id INT NOT NULL, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`');
        $this->addSql('ALTER TABLE nhl_division RENAME INDEX idx_43a4fc207fdf4958 TO conf');
        $this->addSql('ALTER TABLE nhl_match CHANGE season_id season_id INT NOT NULL, CHANGE team_id team_id INT NOT NULL, CHANGE stadia_id stadia_id INT NOT NULL, CHANGE bomb bomb VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`');
        $this->addSql('ALTER TABLE nhl_match RENAME INDEX idx_7c115b3df59e604a TO team2');
        $this->addSql('ALTER TABLE nhl_match RENAME INDEX idx_7c115b3d3721e7b1 TO stadia');
        $this->addSql('ALTER TABLE nhl_match RENAME INDEX idx_7c115b3d4ec001d1 TO nhlseason');
        $this->addSql('ALTER TABLE nhl_match RENAME INDEX idx_7c115b3d296cd8ae TO nhlteam');
        $this->addSql('ALTER TABLE nhl_player CHANGE country_id country_id INT NOT NULL, CHANGE amplua_id amplua_id INT NOT NULL, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, CHANGE goal_reg goal_reg INT DEFAULT 0 NOT NULL, CHANGE goal_play_off goal_play_off INT DEFAULT 0 NOT NULL, CHANGE goal_sum goal_sum INT DEFAULT 0 NOT NULL, CHANGE assist_reg assist_reg INT DEFAULT 0 NOT NULL, CHANGE assist_play_off assist_play_off INT DEFAULT 0 NOT NULL, CHANGE assist_sum assist_sum INT DEFAULT 0 NOT NULL, CHANGE score_reg score_reg INT DEFAULT 0 NOT NULL, CHANGE score_play_off score_play_off INT DEFAULT 0 NOT NULL, CHANGE score_sum score_sum INT DEFAULT 0 NOT NULL, CHANGE translit translit VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, CHANGE game_reg game_reg INT DEFAULT 0 NOT NULL, CHANGE game_play_off game_play_off INT DEFAULT 0 NOT NULL, CHANGE game_sum game_sum INT DEFAULT 0 NOT NULL, CHANGE missed_reg missed_reg INT DEFAULT 0 NOT NULL, CHANGE missed_play_off missed_play_off INT DEFAULT 0 NOT NULL, CHANGE missed_sum missed_sum INT DEFAULT 0 NOT NULL, CHANGE zero_reg zero_reg INT DEFAULT 0 NOT NULL, CHANGE zero_play_off zero_play_off INT DEFAULT 0 NOT NULL, CHANGE zero_sum zero_sum INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE nhl_player RENAME INDEX idx_b01d8865f92f3e70 TO country');
        $this->addSql('ALTER TABLE nhl_player RENAME INDEX idx_b01d88655e09c8d2 TO amplua');
        $this->addSql('ALTER TABLE nhl_players_team CHANGE player_id player_id INT NOT NULL, CHANGE team_id team_id INT NOT NULL');
        $this->addSql('ALTER TABLE nhl_players_team RENAME INDEX idx_dd11eb3d296cd8ae TO nhlplayersteam');
        $this->addSql('ALTER TABLE nhl_players_team RENAME INDEX idx_dd11eb3d99e6f5df TO nhlplayersonteam');
        $this->addSql('ALTER TABLE nhl_reg CHANGE goal goal INT DEFAULT 0 NOT NULL, CHANGE assist assist INT DEFAULT 0 NOT NULL, CHANGE score score INT DEFAULT 0 NOT NULL, CHANGE game game INT DEFAULT 0 NOT NULL, CHANGE missed missed INT DEFAULT 0 NOT NULL, CHANGE zero zero INT DEFAULT 0 NOT NULL, CHANGE game_play_off game_play_off INT DEFAULT 0 NOT NULL, CHANGE game_sum game_sum INT DEFAULT 0 NOT NULL, CHANGE goal_play_off goal_play_off INT DEFAULT 0 NOT NULL, CHANGE goal_sum goal_sum INT DEFAULT 0 NOT NULL, CHANGE assist_play_off assist_play_off INT DEFAULT 0 NOT NULL, CHANGE assist_sum assist_sum INT DEFAULT 0 NOT NULL, CHANGE score_play_off score_play_off INT DEFAULT 0 NOT NULL, CHANGE score_sum score_sum INT DEFAULT 0 NOT NULL, CHANGE missed_play_off missed_play_off INT DEFAULT 0 NOT NULL, CHANGE missed_sum missed_sum INT DEFAULT 0 NOT NULL, CHANGE zero_play_off zero_play_off INT DEFAULT 0 NOT NULL, CHANGE zero_sum zero_sum INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE nhl_reg RENAME INDEX idx_f1c7376e4ec001d1 TO regseason');
        $this->addSql('ALTER TABLE nhl_reg RENAME INDEX idx_f1c7376e296cd8ae TO regteam');
        $this->addSql('ALTER TABLE nhl_reg RENAME INDEX idx_f1c7376e99e6f5df TO regplayer');
        $this->addSql('ALTER TABLE nhl_stadia CHANGE name name VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, CHANGE translit translit VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`');
        $this->addSql('ALTER TABLE nhl_table CHANGE season_id season_id INT NOT NULL, CHANGE team_id team_id INT NOT NULL, CHANGE division_id division_id INT NOT NULL, CHANGE mz mz INT DEFAULT 0 NOT NULL, CHANGE mp mp INT DEFAULT 0 NOT NULL, CHANGE score score INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE nhl_table RENAME INDEX idx_f063117e296cd8ae TO team');
        $this->addSql('ALTER TABLE nhl_table RENAME INDEX idx_f063117e41859289 TO division');
        $this->addSql('ALTER TABLE nhl_table RENAME INDEX idx_f063117e4ec001d1 TO season');
        $this->addSql('ALTER TABLE nhl_team CHANGE name name VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, CHANGE translit translit VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, CHANGE winsreg winsreg INT DEFAULT 0 NOT NULL, CHANGE nichreg nichreg INT DEFAULT 0 NOT NULL, CHANGE porazhreg porazhreg INT DEFAULT 0 NOT NULL, CHANGE mzreg mzreg INT DEFAULT 0 NOT NULL, CHANGE mpreg mpreg INT DEFAULT 0 NOT NULL, CHANGE scorereg scorereg INT DEFAULT 0 NOT NULL, CHANGE winspo winspo INT DEFAULT 0 NOT NULL, CHANGE nichpo nichpo INT DEFAULT 0 NOT NULL, CHANGE porazhpo porazhpo INT DEFAULT 0 NOT NULL, CHANGE mzpo mzpo INT DEFAULT 0 NOT NULL, CHANGE mppo mppo INT DEFAULT 0 NOT NULL, CHANGE scorepo scorepo INT DEFAULT 0 NOT NULL, CHANGE wins wins INT DEFAULT 0 NOT NULL, CHANGE nich nich INT DEFAULT 0 NOT NULL, CHANGE porazh porazh INT DEFAULT 0 NOT NULL, CHANGE mz mz INT DEFAULT 0 NOT NULL, CHANGE mp mp INT DEFAULT 0 NOT NULL, CHANGE score score INT DEFAULT 0 NOT NULL, CHANGE gamereg gamereg INT DEFAULT 0 NOT NULL, CHANGE gamepo gamepo INT DEFAULT 0 NOT NULL, CHANGE game game INT DEFAULT 0 NOT NULL, CHANGE image image VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, CHANGE image2 image2 VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`');
        $this->addSql('ALTER TABLE period RENAME INDEX uniq_c5b81eceb5a459a0 TO UNIQ_C5B81ECE5FB1909');
        $this->addSql('ALTER TABLE player CHANGE amplua_id amplua_id INT DEFAULT NULL, CHANGE country_id country_id INT DEFAULT NULL, CHANGE image image VARCHAR(255) NOT NULL, CHANGE insertdate insertdate DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE sbornie sbornie INT DEFAULT NULL, CHANGE viewed viewed INT DEFAULT 0 NOT NULL');
        $this->addSql('CREATE INDEX born ON player (born)');
        $this->addSql('CREATE INDEX name ON player (name)');
        $this->addSql('ALTER TABLE playersteam CHANGE team_id team_id INT DEFAULT NULL, CHANGE player_id player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE referee CHANGE country_id country_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rusplayer CHANGE player_id player_id INT DEFAULT NULL, CHANGE ecgame ecgame INT DEFAULT 0 NOT NULL, CHANGE ecgoal ecgoal INT DEFAULT 0 NOT NULL, CHANGE cupgame cupgame INT DEFAULT 0 NOT NULL, CHANGE cupgoal cupgoal INT DEFAULT 0 NOT NULL, CHANGE supercupgame supercupgame INT DEFAULT 0 NOT NULL, CHANGE supercupgoal supercupgoal INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE sbplayer CHANGE season_id season_id INT DEFAULT NULL, CHANGE player_id player_id INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX name ON seasons (name)');
        $this->addSql('ALTER TABLE shipplayer CHANGE season_id season_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL, CHANGE player_id player_id INT DEFAULT NULL, CHANGE game game INT DEFAULT 0 NOT NULL, CHANGE sbornie sbornie INT DEFAULT NULL');
        $this->addSql('CREATE INDEX team_id ON shipplayer (team_id, season_id)');
        $this->addSql('ALTER TABLE shiptable CHANGE season_id season_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL, CHANGE country_id country_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sostav CHANGE season_id season_id INT DEFAULT NULL, CHANGE country_id country_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL, CHANGE player_id player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stadia CHANGE id id INT NOT NULL, CHANGE rank rank INT DEFAULT 1');
        $this->addSql('ALTER TABLE supercupplayer CHANGE season_id season_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL, CHANGE player_id player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task CHANGE title title VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb3 NOT NULL COLLATE `utf8mb3_general_ci`, CHANGE dataend dataend DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE team CHANGE country_id country_id INT DEFAULT NULL, CHANGE game game INT DEFAULT 0 NOT NULL, CHANGE wins wins INT DEFAULT 0 NOT NULL, CHANGE nich nich INT DEFAULT 0 NOT NULL, CHANGE porazh porazh INT DEFAULT 0 NOT NULL, CHANGE mz mz INT DEFAULT 0 NOT NULL, CHANGE mp mp INT DEFAULT 0 NOT NULL, CHANGE score score INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE transfer DROP FOREIGN KEY FK_4034A3C039E6FA16');
        $this->addSql('ALTER TABLE transfer DROP FOREIGN KEY FK_4034A3C0BD06B3B3');
        $this->addSql('ALTER TABLE transfer DROP FOREIGN KEY FK_4034A3C0EC8B7ADE');
        $this->addSql('DROP INDEX IDX_4034A3C039E6FA16 ON transfer');
        $this->addSql('DROP INDEX IDX_4034A3C0BD06B3B3 ON transfer');
        $this->addSql('DROP INDEX IDX_4034A3C0EC8B7ADE ON transfer');
        $this->addSql('ALTER TABLE transfer CHANGE old_id old_id INT NOT NULL, CHANGE new_id new_id INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP INDEX UNIQ_8D93D649F85E0677, ADD INDEX username (username)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON DEFAULT NULL, CHANGE is_verified is_verified TINYINT(1) DEFAULT NULL');
    }
}
