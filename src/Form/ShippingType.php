<?php 
namespace App\Form;

use App\Entity\Shipping;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ShippingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder->add('mobile_number',TextType::class,['label'=>'Mobile Number','required'=>true,'attr' => array('style' => 'width:30%;','placeholder' => 'Mobile Number')])
			->add('flat_number',TextType::class,['label'=>'Flat, House no., Building, Company, Apartment: ','required'=>true,'attr' => array('style' => 'width:30%','placeholder' => 'Flat Number')])
			->add('area',TextType::class,['label'=>'Area','required'=>true,'attr' => array('style' => 'width:30%','placeholder' => 'Area')])
			->add('Town',TextType::class,['label'=>'Town','required'=>true,'attr' => array('style' => 'width:30%','placeholder' => 'Town')])
			->add('Pincode',TextType::class,['label'=>'Pincode','required'=>true,'attr' => array('style' => 'width:30%','placeholder' => 'Pincode')])
			->add('State',TextType::class,['label'=>'State','required'=>true,'attr' => array('style' => 'width:30%','placeholder' => 'State')])
			->add('Deliver_to_this_address', SubmitType::class, ['attr' => ['class' => 'btn add-to-cart','name'=>'Deliver to this Address']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shipping::class,
        ]);
    }
}
