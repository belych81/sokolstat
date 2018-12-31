<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181231114827 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE acl_object_identity_ancestors DROP FOREIGN KEY FK_825DE2993D9AB4A6');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors DROP FOREIGN KEY FK_825DE299C671CEA1');
        $this->addSql('DROP TABLE acl_entries');
        $this->addSql('DROP TABLE acl_object_identities');
        $this->addSql('DROP TABLE acl_object_identity_ancestors');
        $this->addSql('DROP TABLE mundial');
        $this->addSql('DROP TABLE voteemail');
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

        $this->addSql('CREATE TABLE acl_entries (id INT UNSIGNED AUTO_INCREMENT NOT NULL, security_identity_id INT UNSIGNED NOT NULL, class_id INT UNSIGNED NOT NULL, object_identity_id INT UNSIGNED DEFAULT NULL, field_name VARCHAR(50) DEFAULT NULL COLLATE utf8_unicode_ci, ace_order SMALLINT UNSIGNED NOT NULL, mask INT NOT NULL, granting TINYINT(1) NOT NULL, granting_strategy VARCHAR(30) NOT NULL COLLATE utf8_unicode_ci, audit_success TINYINT(1) NOT NULL, audit_failure TINYINT(1) NOT NULL, INDEX IDX_46C8B806EA000B103D9AB4A6DF9183C9 (class_id, object_identity_id, security_identity_id), INDEX IDX_46C8B8063D9AB4A6 (object_identity_id), UNIQUE INDEX UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4 (class_id, object_identity_id, field_name, ace_order), INDEX IDX_46C8B806EA000B10 (class_id), INDEX IDX_46C8B806DF9183C9 (security_identity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE acl_object_identities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, parent_object_identity_id INT UNSIGNED DEFAULT NULL, class_id INT UNSIGNED NOT NULL, object_identifier VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, entries_inheriting TINYINT(1) NOT NULL, INDEX IDX_9407E54977FA751A (parent_object_identity_id), UNIQUE INDEX UNIQ_9407E5494B12AD6EA000B10 (object_identifier, class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE acl_object_identity_ancestors (object_identity_id INT UNSIGNED NOT NULL, ancestor_id INT UNSIGNED NOT NULL, INDEX IDX_825DE2993D9AB4A6 (object_identity_id), INDEX IDX_825DE299C671CEA1 (ancestor_id), PRIMARY KEY(object_identity_id, ancestor_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mundial (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, country_id INT DEFAULT NULL, country2_id INT DEFAULT NULL, turnir_id INT DEFAULT NULL, stadia_id INT DEFAULT NULL, city_id INT DEFAULT NULL, referee_id INT DEFAULT NULL, goal VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, score VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, game VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, game2 VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, penalty VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, data DATETIME NOT NULL, zriteli INT NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_C140406B8BAC62AF (city_id), INDEX IDX_C140406BF92F3E70 (country_id), INDEX IDX_C140406B2AEBD7A2 (turnir_id), INDEX IDX_C140406B4A087CA2 (referee_id), INDEX IDX_C140406B4EC001D1 (season_id), INDEX IDX_C140406B9425DC7F (country2_id), INDEX IDX_C140406B3721E7B1 (stadia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE voteemail (id INT AUTO_INCREMENT NOT NULL, vote_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_DD5FD5E72DCDAFC (vote_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806DF9183C9 FOREIGN KEY (security_identity_id) REFERENCES acl_security_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE2993D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE299C671CEA1 FOREIGN KEY (ancestor_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mundial ADD CONSTRAINT FK_C140406B2AEBD7A2 FOREIGN KEY (turnir_id) REFERENCES turnir (id)');
        $this->addSql('ALTER TABLE mundial ADD CONSTRAINT FK_C140406B3721E7B1 FOREIGN KEY (stadia_id) REFERENCES stadia (id)');
        $this->addSql('ALTER TABLE mundial ADD CONSTRAINT FK_C140406B4EC001D1 FOREIGN KEY (season_id) REFERENCES seasons (id)');
        $this->addSql('ALTER TABLE mundial ADD CONSTRAINT FK_C140406B8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE mundial ADD CONSTRAINT FK_C140406B9425DC7F FOREIGN KEY (country2_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE mundial ADD CONSTRAINT FK_C140406BF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE voteemail ADD CONSTRAINT FK_DD5FD5E72DCDAFC FOREIGN KEY (vote_id) REFERENCES vote (id)');
        $this->addSql('ALTER TABLE country CHANGE translit translit VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE eurocup CHANGE season_id season_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL, CHANGE team2_id team2_id INT DEFAULT NULL, CHANGE stadia_id stadia_id INT DEFAULT NULL, CHANGE turnir_id turnir_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player CHANGE amplua_id amplua_id INT DEFAULT NULL, CHANGE country_id country_id INT DEFAULT NULL, CHANGE image image VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE rfplmatch CHANGE season_id season_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shipplayer CHANGE season_id season_id INT DEFAULT NULL, CHANGE team_id team_id INT DEFAULT NULL, CHANGE player_id player_id INT DEFAULT NULL');
    }
}
