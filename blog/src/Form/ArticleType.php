<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\FormBuilderInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
            ->add('title', TextType::class)
            ->add('subtitle', TextType::class)
            ->add('content', TextareaType::class)
            ->add('title', TextType::class)
            /*->add('date', DateTimeType::class)
            ->add('author', TextType::class)*/
            ->add('save', SubmitType::class)
        ;
    }
}