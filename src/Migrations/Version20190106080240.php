<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190106080240 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, descriptive_text LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manga (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, short_description VARCHAR(255) NOT NULL, long_description LONGTEXT NOT NULL, main_image VARCHAR(255) NOT NULL, secondary1_image VARCHAR(255) NOT NULL, secondary2_image VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manga_category (manga_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_71D59E827B6461 (manga_id), INDEX IDX_71D59E8212469DE2 (category_id), PRIMARY KEY(manga_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_manga (id INT AUTO_INCREMENT NOT NULL, manga_id INT NOT NULL, orderr_id INT DEFAULT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_F5C4EAFE7B6461 (manga_id), INDEX IDX_F5C4EAFE7742FDB3 (orderr_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orderr (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, manga_id INT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, comment LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_794381C67B6461 (manga_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE manga_category ADD CONSTRAINT FK_71D59E827B6461 FOREIGN KEY (manga_id) REFERENCES manga (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE manga_category ADD CONSTRAINT FK_71D59E8212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_manga ADD CONSTRAINT FK_F5C4EAFE7B6461 FOREIGN KEY (manga_id) REFERENCES manga (id)');
        $this->addSql('ALTER TABLE order_manga ADD CONSTRAINT FK_F5C4EAFE7742FDB3 FOREIGN KEY (orderr_id) REFERENCES orderr (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C67B6461 FOREIGN KEY (manga_id) REFERENCES manga (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE manga_category DROP FOREIGN KEY FK_71D59E8212469DE2');
        $this->addSql('ALTER TABLE manga_category DROP FOREIGN KEY FK_71D59E827B6461');
        $this->addSql('ALTER TABLE order_manga DROP FOREIGN KEY FK_F5C4EAFE7B6461');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C67B6461');
        $this->addSql('ALTER TABLE order_manga DROP FOREIGN KEY FK_F5C4EAFE7742FDB3');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE manga');
        $this->addSql('DROP TABLE manga_category');
        $this->addSql('DROP TABLE order_manga');
        $this->addSql('DROP TABLE orderr');
        $this->addSql('DROP TABLE review');
    }
}
