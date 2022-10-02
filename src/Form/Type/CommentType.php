<?php

namespace App\Form\Type;

use App\Entity\Article;
use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => 'Votre message'
            ])
            ->add('article', HiddenType::class)
            ->add('send', SubmitType::class, [
                'label' => 'Envoyer'
            ]);

        /**
         * BCP de choses nouvelles !
         * Permet de transformer la valeur que l'on va injecter dans le "value" de l'input article du formulaire
         * L'article renvoie par défaut le titre de l'article comme valeur, le modelTransformer permet de le transformer en id puis le retransformer en titre
         * Utilisation des fonctions fléchées en PHP  
         * 19:12
         */
        $builder->get('article')
            ->addModelTransformer(new CallbackTransformer(
                fn (Article $article) => $article->getId(),
                fn (Article $article) => $article->getTitle()
            ));
    }


    /**
     * Informe Symfony que le formulaire travaille avec un objet de type Comment
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
            'csrf_token_id' => 'comment-add'
        ]);
    }
}
