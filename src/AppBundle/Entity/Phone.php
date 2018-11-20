<?php declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="phone")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhoneRepository")
 */
class Phone
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * var UuidInterface|null
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @var string $number
     */
    public $number;

    /**
     * Many Phones have One Contact.
     * @ORM\ManyToOne(targetEntity="Contact", inversedBy="phones", cascade={"persist"})
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     */
    public $contact;

    /**
     * Address constructor.
     */
    public function __construct()
    {
        $this->id   = Uuid::uuid4();
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
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
    }

    public function __toString()
    {
        return $this->number;
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