<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Entity\Souscategorie;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use App\Repository\SouscategorieRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ArticleType extends AbstractType
{
    private $categorie;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image')
            ->add('nom')
            ->add('couleur')
            ->add('description')
            ->add('statut')
            ->add('stock')
            ->add('prix')
            // ->add('slug')
            ->add('promotion');
                if($options['edition'] === 'new'){
                    $builder
                        ->add('categorie', EntityType::class,[
                            'class' => Categorie::class,
                            'choice_label' => 'nom',
                            'choice_value' => 'id',
                            'placeholder' => 'selectionner une option',
                        ])
                        ->add('souscategorie', ChoiceType::class,[
                            'placeholder' => 'selectionner une option',
                            'attr' => [
                                'disabled' => true
                            ],        
                        ]);
                }
                else{
                    $this->categorie = $options['categorie'];
                    $builder
                        ->add('categorie', EntityType::class,[
                            'class' => Categorie::class,
                            'choice_label' => 'nom',
                            'choice_value' => 'id',
                            'data' => $this->categorie,
                        ])
                        ->add('souscategorie', EntityType::class, [
                        'label' => 'Marque',
                        'class' => Souscategorie::class,
                        'choice_label' => 'nom',
                        'choice_value' => 'id',
                        'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('s')
                                ->where('s.statut = :statut')
                                ->andWhere('s.categorie = :categorie')
                                ->setParameter('statut', true)
                                ->setParameter('categorie', $this->categorie);
                        },
                    ]);    
                };
            
            // Recupére les sous catégorie a partir de la catégorie sélectionner
            $addSousCategoriesForm = function (FormInterface $form, $categorie) {
                if (!empty($categorie)) {
                    $this->categorie = $categorie;
                        $form->add('souscategorie', EntityType::class, [
                            'label' => 'Marque',
                           'class' => Souscategorie::class,
                           'choice_label' => 'nom',
                           'choice_value' => 'id',
                           'query_builder' => function (EntityRepository $er) {
                              return $er->createQueryBuilder('s')
                                    ->where('s.statut = :statut')
                                    ->andWhere('s.categorie = :categorie')
                                    ->setParameter('statut', true)
                                    ->setParameter('categorie', $this->categorie);
                           },
                           'placeholder' => 'Sélectionner une marque',
                        ]);  
                }
            };

            $builder->addEventListener(
                FormEvents::PRE_SET_DATA,
                function (FormEvent $event) use ($addSousCategoriesForm) {
                    $data = $event->getData();
                    $categorie = $data ? $data->getCategorie() : null;
                    $addSousCategoriesForm($event->getForm(), $categorie);
                }
            );
            $builder->addEventListener(
                FormEvents::PRE_SUBMIT,
                function (FormEvent $event) use ($addSousCategoriesForm) {
                    $data = $event->getData();
                    $categorie = array_key_exists('categorie', $data) ? $data['categorie'] : null;
                    $addSousCategoriesForm($event->getForm(), $categorie);
                }
            );
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'edition' => null,
            'categorie' => null
        ]);
    }
}
