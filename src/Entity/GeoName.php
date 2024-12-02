<?php

namespace Bordeux\Bundle\GeoNameBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GeoName
 */
#[ORM\Table(name: 'geo__name')]
#[ORM\Index(name: 'geoname_geoname_search_idx', columns: ['name', 'country_code'])]
#[ORM\Index(name: 'geoname_feature_code_idx', columns: ['feature_code'])]
#[ORM\Entity]
class GeoName
{
    /**
     * @var int
     */
    #[ORM\Column(name: 'id', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    protected int $id;


    /**
     * @var string
     */
    #[ORM\Column(name: 'name', type: 'string', length: 200, nullable: false)]
    protected string $name;

    /**
     * @var string
     */
    #[ORM\Column(name: 'ascii_name', type: 'string', length: 200, nullable: true)]
    protected ?string $asciiName = null;


    /**
     * @var float
     */
    #[ORM\Column(name: 'latitude', type: 'float', scale: 6, precision: 9, nullable: true)]
    protected ?float $latitude = null;

    /**
     * @var float
     */
    #[ORM\Column(name: 'longitude', type: 'float', scale: 6, precision: 9, nullable: true)]
    protected ?float $longitude = null;

    /**
     * @var string|null
     */
    #[ORM\Column(name: 'feature_class', type: 'string', length: 1, nullable: true)]
    protected ?string $featureClass = null;

    /**
     * @var string|null
     */
    #[ORM\Column(name: 'feature_code', type: 'string', length: 10, nullable: true)]
    protected ?string $featureCode = null;

    /**
     * @var string|null
     */
    #[ORM\Column(name: 'country_code', type: 'string', length: 2, nullable: true)]
    protected ?string $countryCode = null;

    /**
     * @var Country|null
     */
    #[ORM\JoinColumn(name: 'country_id', referencedColumnName: 'id', nullable: true)]
    #[ORM\ManyToOne(targetEntity: \Bordeux\Bundle\GeoNameBundle\Entity\Country::class)]
    protected ?Country $country = null;

    /**
     * @var string|null
     */
    #[ORM\Column(name: 'cc2', type: 'string', length: 200, nullable: true)]
    protected ?string $cc2 = null;

    /**
     * @var Administrative
     */
    #[ORM\JoinColumn(name: 'admin1_id', referencedColumnName: 'id', nullable: true)]
    #[ORM\ManyToOne(targetEntity: \Bordeux\Bundle\GeoNameBundle\Entity\Administrative::class)]
    protected ?Administrative $admin1 = null;

    /**
     * @var Administrative
     */
    #[ORM\JoinColumn(name: 'admin2_id', referencedColumnName: 'id', nullable: true)]
    #[ORM\ManyToOne(targetEntity: \Bordeux\Bundle\GeoNameBundle\Entity\Administrative::class)]
    protected ?Administrative $admin2 = null;

    /**
     * @var Administrative
     */
    #[ORM\JoinColumn(name: 'admin3_id', referencedColumnName: 'id', nullable: true)]
    #[ORM\ManyToOne(targetEntity: \Bordeux\Bundle\GeoNameBundle\Entity\Administrative::class)]
    protected ?Administrative $admin3 = null;

    /**
     * @var Administrative
     */
    #[ORM\JoinColumn(name: 'admin4_id', referencedColumnName: 'id', nullable: true)]
    #[ORM\ManyToOne(targetEntity: \Bordeux\Bundle\GeoNameBundle\Entity\Administrative::class)]
    protected ?Administrative $admin4 = null;

    /**
     * @var int|null
     */
    #[ORM\Column(name: 'population', type: 'bigint', nullable: true)]
    protected ?int $population = null;

    /**
     * @var int|null
     */
    #[ORM\Column(name: 'elevation', type: 'integer', nullable: true)]
    protected ?int $elevation = null;

    /**
     * @var int|null
     */
    #[ORM\Column(name: 'dem', type: 'integer', nullable: true)]
    protected ?int $dem = null;

    /**
     * @var Timezone
     */
    #[ORM\JoinColumn(name: 'timezone_id', referencedColumnName: 'id', nullable: true)]
    #[ORM\ManyToOne(targetEntity: \Bordeux\Bundle\GeoNameBundle\Entity\Timezone::class)]
    protected ?Timezone $timezone = null;

    /**
     * @var DateTime|null
     */
    #[ORM\Column(name: 'modification_date', type: 'date', nullable: true)]
    protected ?DateTime $modificationDate = null;

    /**
     * @var Hierarchy[]
     */
    #[ORM\OneToMany(targetEntity: \Bordeux\Bundle\GeoNameBundle\Entity\Hierarchy::class, mappedBy: 'child')]
    protected $parents;

    /**
     * @var ArrayCollection|AlternateName[]
     */
    #[ORM\OneToMany(targetEntity: \Bordeux\Bundle\GeoNameBundle\Entity\AlternateName::class, mappedBy: 'geoName')]
    protected $alternateNames;

    /**
     * GeoName constructor.
     */
    public function __construct()
    {
        $this->alternateNames = new ArrayCollection();
    }


    /**
     * @return int|null
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
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAsciiName(): ?string
    {
        return $this->asciiName;
    }

    /**
     * @param string|null $asciiName
     * @return $this
     */
    public function setAsciiName(?string $asciiName): self
    {
        $this->asciiName = $asciiName;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param float|null $latitude
     * @return $this
     */
    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param float|null $longitude
     * @return $this
     */
    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFeatureClass(): ?string
    {
        return $this->featureClass;
    }

    /**
     * @param string|null $featureClass
     * @return $this
     */
    public function setFeatureClass(?string $featureClass): self
    {
        $this->featureClass = $featureClass;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFeatureCode(): ?string
    {
        return $this->featureCode;
    }

    /**
     * @param string|null $featureCode
     * @return $this
     */
    public function setFeatureCode(?string $featureCode): self
    {
        $this->featureCode = $featureCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @param string|null $countryCode
     * @return $this
     */
    public function setCountryCode(?string $countryCode): self
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCc2(): ?string
    {
        return $this->cc2;
    }

    /**
     * @param string|null $cc2
     * @return $this
     */
    public function setCc2(?string $cc2): self
    {
        $this->cc2 = $cc2;
        return $this;
    }

    /**
     * @return Administrative|null
     */
    public function getAdmin1(): ?Administrative
    {
        return $this->admin1;
    }

    /**
     * @param Administrative|null $admin1
     * @return $this
     */
    public function setAdmin1(?Administrative $admin1): self
    {
        $this->admin1 = $admin1;
        return $this;
    }

    /**
     * @return Administrative|null
     */
    public function getAdmin2(): ?Administrative
    {
        return $this->admin2;
    }

    /**
     * @param Administrative|null $admin2
     * @return $this
     */
    public function setAdmin2(?Administrative $admin2): self
    {
        $this->admin2 = $admin2;
        return $this;
    }

    /**
     * @return Administrative|null
     */
    public function getAdmin3(): ?Administrative
    {
        return $this->admin3;
    }

    /**
     * @param Administrative|null $admin3
     * @return $this
     */
    public function setAdmin3(?Administrative $admin3): self
    {
        $this->admin3 = $admin3;
        return $this;
    }

    /**
     * @return Administrative|null
     */
    public function getAdmin4(): ?Administrative
    {
        return $this->admin4;
    }

    /**
     * @param Administrative|null $admin4
     * @return $this
     */
    public function setAdmin4(?Administrative $admin4): self
    {
        $this->admin4 = $admin4;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPopulation(): ?int
    {
        return $this->population;
    }

    /**
     * @param int|null $population
     * @return $this
     */
    public function setPopulation(?int $population): self
    {
        $this->population = $population;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getElevation(): ?int
    {
        return $this->elevation;
    }

    /**
     * @param int|null $elevation
     * @return $this
     */
    public function setElevation(?int $elevation): self
    {
        $this->elevation = $elevation;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getDem(): ?int
    {
        return $this->dem;
    }

    /**
     * @param int|null $dem
     * @return $this
     */
    public function setDem(?int $dem): self
    {
        $this->dem = $dem;
        return $this;
    }

    /**
     * @return Timezone|null
     */
    public function getTimezone(): ?Timezone
    {
        return $this->timezone;
    }

    /**
     * @param Timezone|null $timezone
     * @return $this
     */
    public function setTimezone(?Timezone $timezone): self
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getModificationDate(): ?DateTime
    {
        return $this->modificationDate;
    }

    /**
     * @param DateTime|null $modificationDate
     * @return $this
     */
    public function setModificationDate(?DateTime $modificationDate): self
    {
        $this->modificationDate = $modificationDate;
        return $this;
    }

    /**
     * @return Country|null
     */
    public function getCountry(): ?Country
    {
        return $this->country;
    }

    /**
     * @return Collection|AlternateName[]
     */
    public function getAlternateNames(): ?Collection
    {
        return $this->alternateNames;
    }
}
