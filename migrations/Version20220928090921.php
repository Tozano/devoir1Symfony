<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220928090921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, referent_id INT NOT NULL, nom_e VARCHAR(50) NOT NULL, type VARCHAR(50) NOT NULL, INDEX IDX_20FD592C35E47E35 (referent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement_professeur (etablissement_id INT NOT NULL, professeur_id INT NOT NULL, INDEX IDX_23A654E8FF631228 (etablissement_id), INDEX IDX_23A654E8BAB22EE9 (professeur_id), PRIMARY KEY(etablissement_id, professeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, nom_p VARCHAR(50) NOT NULL, prenom_p VARCHAR(50) NOT NULL, rue_p VARCHAR(50) NOT NULL, ville_p VARCHAR(50) NOT NULL, code_postal VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592C35E47E35 FOREIGN KEY (referent_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE etablissement_professeur ADD CONSTRAINT FK_23A654E8FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etablissement_professeur ADD CONSTRAINT FK_23A654E8BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592C35E47E35');
        $this->addSql('ALTER TABLE etablissement_professeur DROP FOREIGN KEY FK_23A654E8FF631228');
        $this->addSql('ALTER TABLE etablissement_professeur DROP FOREIGN KEY FK_23A654E8BAB22EE9');
        $this->addSql('DROP TABLE etablissement');
        $this->addSql('DROP TABLE etablissement_professeur');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE user');
    }
}
