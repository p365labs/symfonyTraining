<?php declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Address
 * @ORM\Entity
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressRepository")
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * var UuidInterface|null
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @var string $address
     */
    public $address;

    /**
     * @ORM\Column(type="string", length=100)
     * @var string $zip
     */
    public $zip;

    /**
     * @ORM\Column(type="string", length=100)
     * @var string $country
     */
    public $country;

    /**
     * Many Addresses have One Contact.
     * @ORM\ManyToOne(targetEntity="Contact", inversedBy="addresses", cascade={"persist"})
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     */
    public $contact;

    /**
     * Address constructor.
     */
    public function __construct()
    {
        $this->id       = Uuid::uuid4();
        $this->address  = "";
        $this->zip      = "";
        $this->country  = "";
    }

    /**
     * @return UuidInterface $id
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getZip(): string
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip($zip): void
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }


    /**
     * @return Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param Contact $contact
     */
    public function setContact(Contact $contact): void
    {
        $this->contact = $contact;
    }
}