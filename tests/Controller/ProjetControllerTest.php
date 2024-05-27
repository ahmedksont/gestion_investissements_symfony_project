<?php

namespace App\Test\Controller;

use App\Entity\Projet;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjetControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ProjetRepository $repository;
    private string $path = '/projet/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Projet::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Projet index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'projet[LibelleP]' => 'Testing',
            'projet[SecteurP]' => 'Testing',
            'projet[CoutFixe]' => 'Testing',
            'projet[CoutVar]' => 'Testing',
            'projet[DureeP]' => 'Testing',
            'projet[convention]' => 'Testing',
        ]);

        self::assertResponseRedirects('/projet/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Projet();
        $fixture->setLibelleP('My Title');
        $fixture->setSecteurP('My Title');
        $fixture->setCoutFixe('My Title');
        $fixture->setCoutVar('My Title');
        $fixture->setDureeP('My Title');
        $fixture->setConvention('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Projet');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Projet();
        $fixture->setLibelleP('My Title');
        $fixture->setSecteurP('My Title');
        $fixture->setCoutFixe('My Title');
        $fixture->setCoutVar('My Title');
        $fixture->setDureeP('My Title');
        $fixture->setConvention('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'projet[LibelleP]' => 'Something New',
            'projet[SecteurP]' => 'Something New',
            'projet[CoutFixe]' => 'Something New',
            'projet[CoutVar]' => 'Something New',
            'projet[DureeP]' => 'Something New',
            'projet[convention]' => 'Something New',
        ]);

        self::assertResponseRedirects('/projet/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getLibelleP());
        self::assertSame('Something New', $fixture[0]->getSecteurP());
        self::assertSame('Something New', $fixture[0]->getCoutFixe());
        self::assertSame('Something New', $fixture[0]->getCoutVar());
        self::assertSame('Something New', $fixture[0]->getDureeP());
        self::assertSame('Something New', $fixture[0]->getConvention());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Projet();
        $fixture->setLibelleP('My Title');
        $fixture->setSecteurP('My Title');
        $fixture->setCoutFixe('My Title');
        $fixture->setCoutVar('My Title');
        $fixture->setDureeP('My Title');
        $fixture->setConvention('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/projet/');
    }
}
