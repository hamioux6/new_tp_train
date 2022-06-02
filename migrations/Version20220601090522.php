<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601090522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE arret (id INT AUTO_INCREMENT NOT NULL, gare_id INT NOT NULL, train_id INT NOT NULL, heure_arrivee TIME NOT NULL, heure_depart TIME NOT NULL, INDEX IDX_BBD1570E63FD956 (gare_id), INDEX IDX_BBD1570E23BCD4D0 (train_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(13) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_companie (client_id INT NOT NULL, companie_id INT NOT NULL, INDEX IDX_6DD2BBC619EB6921 (client_id), INDEX IDX_6DD2BBC69DC4CE1F (companie_id), PRIMARY KEY(client_id, companie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE companie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, annule TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gare (id INT AUTO_INCREMENT NOT NULL, ville_id INT NOT NULL, nom VARCHAR(50) NOT NULL, INDEX IDX_EE713F12A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passager (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, train_id INT NOT NULL, companie_id INT NOT NULL, client_id INT NOT NULL, passager_id INT NOT NULL, confirme TINYINT(1) NOT NULL, annule TINYINT(1) NOT NULL, INDEX IDX_42C8495523BCD4D0 (train_id), INDEX IDX_42C849559DC4CE1F (companie_id), INDEX IDX_42C8495519EB6921 (client_id), INDEX IDX_42C8495571A51189 (passager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE train (id INT AUTO_INCREMENT NOT NULL, gare_depart_id INT NOT NULL, gare_arrivee_id INT NOT NULL, companie_id INT NOT NULL, numero INT NOT NULL, heure_depart TIME NOT NULL, heure_arrivee TIME NOT NULL, date_depart DATE NOT NULL, date_arrivee DATE NOT NULL, INDEX IDX_5C66E4A32284DC4 (gare_depart_id), INDEX IDX_5C66E4A3975BCA40 (gare_arrivee_id), INDEX IDX_5C66E4A39DC4CE1F (companie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, cp INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE arret ADD CONSTRAINT FK_BBD1570E63FD956 FOREIGN KEY (gare_id) REFERENCES gare (id)');
        $this->addSql('ALTER TABLE arret ADD CONSTRAINT FK_BBD1570E23BCD4D0 FOREIGN KEY (train_id) REFERENCES train (id)');
        $this->addSql('ALTER TABLE client_companie ADD CONSTRAINT FK_6DD2BBC619EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_companie ADD CONSTRAINT FK_6DD2BBC69DC4CE1F FOREIGN KEY (companie_id) REFERENCES companie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gare ADD CONSTRAINT FK_EE713F12A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495523BCD4D0 FOREIGN KEY (train_id) REFERENCES train (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559DC4CE1F FOREIGN KEY (companie_id) REFERENCES companie (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495571A51189 FOREIGN KEY (passager_id) REFERENCES passager (id)');
        $this->addSql('ALTER TABLE train ADD CONSTRAINT FK_5C66E4A32284DC4 FOREIGN KEY (gare_depart_id) REFERENCES gare (id)');
        $this->addSql('ALTER TABLE train ADD CONSTRAINT FK_5C66E4A3975BCA40 FOREIGN KEY (gare_arrivee_id) REFERENCES gare (id)');
        $this->addSql('ALTER TABLE train ADD CONSTRAINT FK_5C66E4A39DC4CE1F FOREIGN KEY (companie_id) REFERENCES companie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_companie DROP FOREIGN KEY FK_6DD2BBC619EB6921');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495519EB6921');
        $this->addSql('ALTER TABLE client_companie DROP FOREIGN KEY FK_6DD2BBC69DC4CE1F');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559DC4CE1F');
        $this->addSql('ALTER TABLE train DROP FOREIGN KEY FK_5C66E4A39DC4CE1F');
        $this->addSql('ALTER TABLE arret DROP FOREIGN KEY FK_BBD1570E63FD956');
        $this->addSql('ALTER TABLE train DROP FOREIGN KEY FK_5C66E4A32284DC4');
        $this->addSql('ALTER TABLE train DROP FOREIGN KEY FK_5C66E4A3975BCA40');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495571A51189');
        $this->addSql('ALTER TABLE arret DROP FOREIGN KEY FK_BBD1570E23BCD4D0');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495523BCD4D0');
        $this->addSql('ALTER TABLE gare DROP FOREIGN KEY FK_EE713F12A73F0036');
        $this->addSql('DROP TABLE arret');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_companie');
        $this->addSql('DROP TABLE companie');
        $this->addSql('DROP TABLE gare');
        $this->addSql('DROP TABLE passager');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE train');
        $this->addSql('DROP TABLE ville');
    }
}
