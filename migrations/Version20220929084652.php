<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220929084652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creation of relation between movies and persons';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE movie_person (movie_id INT NOT NULL, person_id INT NOT NULL, roles JSON NOT NULL, INDEX IDX_CD1B4C038F93B6FC (movie_id), INDEX IDX_CD1B4C03217BBB47 (person_id), PRIMARY KEY(movie_id, person_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_person ADD CONSTRAINT FK_CD1B4C038F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE movie_person ADD CONSTRAINT FK_CD1B4C03217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE movie_person DROP FOREIGN KEY FK_CD1B4C038F93B6FC');
        $this->addSql('ALTER TABLE movie_person DROP FOREIGN KEY FK_CD1B4C03217BBB47');
        $this->addSql('DROP TABLE movie_person');
    }
}
