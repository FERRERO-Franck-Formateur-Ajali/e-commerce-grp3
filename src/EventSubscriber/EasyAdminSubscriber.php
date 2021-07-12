<?php

namespace App\EventSubscriber;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $slugmaker;
    private $souscategorie;

    public function __construct(SluggerInterface $slugmaker)
    {
        $this->slugmaker = $slugmaker;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setArticleSlugAndSouscategorie'],
        ];
    }

    public function setArticleSlugAndSouscategorie(BeforeEntityPersistedEvent $event){
        
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Article)){
            return;
        }

        $slug = $this->slugger->slug($entity->getNom());
        $entity->setSlug($slug);
    }
}