<?php declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="account")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AccountRepository")
 */
class Account
{
    const ACCOUNT_TYPE_PRIVATE  = false;
    const ACCOUNT_TYPE_BUSINESS = true;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="boolean")
     */
    public $type;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public $tax_code;

    /**
     * One Account has One Contact.
     * @ORM\OneToOne(targetEntity="Contact", inversedBy="account", cascade={"persist"})
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     * @var Contact $contact
     */
    public $contact;

    public function __construct()
    {
        $this->type         = Account::ACCOUNT_TYPE_PRIVATE;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function getType(): bool
    {
        return $this->type;
    }

    /**
     * @param bool $type
     */
    public function setType(bool $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getTaxCode(): string
    {
        return $this->tax_code;
    }

    /**
     * @param string $tax_code
     */
    public function setTaxCode($tax_code): void
    {
        $this->tax_code = $tax_code;
    }

    /**
     * @return Contact
     */
    public function getContact(): Contact
    {
        return $this->contact;
    }

    /**
     * @param Contact $contact
     */
    public function setContacts(Contact $contact): void
    {
        $this->contact = $contact;
    }
}