<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="profile")
 */
class Profile
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $nickname;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $birthdayLat;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $birthdayLong;

    /**
     * @var string
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $birthdayCity;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", nullable=true)
     */
    private $deathday;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $deathdayLat;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $deathdayLong;

    /**
     * @var string
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $deathdayCity;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", nullable=true)
     */
    private $baptismday;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $baptismdayLat;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $baptismdayLong;

    /**
     * @var string
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $baptismdayCity;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Profile
     */
    public function setName(string $name): ?Profile
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     * @return Profile
     */
    public function setNickname(?string $nickname): ?Profile
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthday(): ?\DateTime
    {
        return $this->birthday;
    }

    /**
     * @param \DateTime $birthday
     * @return Profile
     */
    public function setBirthday(\DateTime $birthday): ?Profile
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return float
     */
    public function getBirthdayLat(): ?float
    {
        return $this->birthdayLat;
    }

    /**
     * @param float $birthdayLat
     * @return Profile
     */
    public function setBirthdayLat(?float $birthdayLat): ?Profile
    {
        $this->birthdayLat = $birthdayLat;
        return $this;
    }

    /**
     * @return float
     */
    public function getBirthdayLong(): ?float
    {
        return $this->birthdayLong;
    }

    /**
     * @param float $birthdayLong
     * @return Profile
     */
    public function setBirthdayLong(?float $birthdayLong): ?Profile
    {
        $this->birthdayLong = $birthdayLong;
        return $this;
    }

    /**
     * @return string
     */
    public function getBirthdayCity(): ?string
    {
        return $this->birthdayCity;
    }

    /**
     * @param string $birthdayCity
     * @return Profile
     */
    public function setBirthdayCity(?string $birthdayCity): ?Profile
    {
        $this->birthdayCity = $birthdayCity;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeathday(): ?\DateTime
    {
        return $this->deathday;
    }

    /**
     * @param \DateTime $deathday
     * @return Profile
     */
    public function setDeathday(\DateTime $deathday): ?Profile
    {
        $this->deathday = $deathday;
        return $this;
    }

    /**
     * @return float
     */
    public function getDeathdayLat(): ?float
    {
        return $this->deathdayLat;
    }

    /**
     * @param float $deathdayLat
     * @return Profile
     */
    public function setDeathdayLat(?float $deathdayLat): ?Profile
    {
        $this->deathdayLat = $deathdayLat;
        return $this;
    }

    /**
     * @return float
     */
    public function getDeathdayLong(): ?float
    {
        return $this->deathdayLong;
    }

    /**
     * @param float $deathdayLong
     * @return Profile
     */
    public function setDeathdayLong(?float $deathdayLong): ?Profile
    {
        $this->deathdayLong = $deathdayLong;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeathdayCity(): ?string
    {
        return $this->deathdayCity;
    }

    /**
     * @param string $deathdayCity
     * @return Profile
     */
    public function setDeathdayCity(?string $deathdayCity): ?Profile
    {
        $this->deathdayCity = $deathdayCity;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBaptismday(): ?\DateTime
    {
        return $this->baptismday;
    }

    /**
     * @param \DateTime $baptismday
     * @return Profile
     */
    public function setBaptismday(\DateTime $baptismday): ?Profile
    {
        $this->baptismday = $baptismday;
        return $this;
    }

    /**
     * @return float
     */
    public function getBaptismdayLat(): ?float
    {
        return $this->baptismdayLat;
    }

    /**
     * @param float $baptismdayLat
     * @return Profile
     */
    public function setBaptismdayLat(?float $baptismdayLat): ?Profile
    {
        $this->baptismdayLat = $baptismdayLat;
        return $this;
    }

    /**
     * @return float
     */
    public function getBaptismdayLong(): ?float
    {
        return $this->baptismdayLong;
    }

    /**
     * @param float $baptismdayLong
     * @return Profile
     */
    public function setBaptismdayLong(?float $baptismdayLong): ?Profile
    {
        $this->baptismdayLong = $baptismdayLong;
        return $this;
    }

    /**
     * @return string
     */
    public function getBaptismdayCity(): ?string
    {
        return $this->baptismdayCity;
    }

    /**
     * @param string $baptismdayCity
     * @return Profile
     */
    public function setBaptismdayCity(?string $baptismdayCity): ?Profile
    {
        $this->baptismdayCity = $baptismdayCity;
        return $this;
    }


}