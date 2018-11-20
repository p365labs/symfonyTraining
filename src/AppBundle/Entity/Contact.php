<?php declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public $surname;

    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="contact", cascade={"persist"})
     *
     * @var Collection $address
     */
    public $addresses;

    /**
     * @ORM\OneToMany(targetEntity="Phone", mappedBy="contact", cascade={"persist"})
     *
     * @var Collection $phone
     */
    public $phones;

    /**
     * One Contact has One Account.
     * @ORM\OneToOne(targetEntity="Account", mappedBy="contact", cascade={"persist"})
     */
    public $account;

    public function __construct()
    {
        $this->name         = "";
        $this->surname      = "";
        $this->addresses    = new ArrayCollection();
        $this->phones       = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return Collection
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    /**
     * @param Collection $addresses
     */
    public function setAddresses(Collection $addresses): void
    {
        $this->addresses = $addresses;
    }

    /**
     * @param Address $address
     */
    public function addAddress(Address $address): void
    {
        // needed to update the owning side of the relationship!
        $address->setContact($this);
        $this->addresses->add($address);
    }

    /**
     * @param Address $address
     */
    public function removeAddress(Address $address): void
    {
//        $address->setContact(null);
        $this->addresses->removeElement($address);
    }

    /**
     * @return Collection
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * @param Collection $phones
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;
    }

    /**
     * @param Phone $phone
     */
    public function addPhone(Phone $phone)
    {
        // needed to update the owning side of the relationship!
        $phone->setContact($this);
        $this->phones->add($phone);
    }

    /**
     * @param Phone $phone
     */
    public function removePhone(Phone $phone)
    {
//        $phone->setContact(null);
        $this->phones->removeElement($phone);
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param Account $account
     */
    public function setAccount(Account $account): void
    {
        $this->account = $account;
    }

    public function __toString()
    {
        return $this->name;
    }
}