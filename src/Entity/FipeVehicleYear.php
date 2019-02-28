<?php

namespace Syclass\FipeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicle Year
 *
 * @ORM\Table(name="fipe_vehicle_year")
 * @ORM\Entity(repositoryClass="Syclass\FipeBundle\Repository\FipeVehicleYearRepository")

 */
class FipeVehicleYear
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=40, nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=60, nullable=false)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="FipeVehicle", inversedBy="years")
     * @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id")
     **/
    private $vehicle;

    /**
     * @ORM\ManyToOne(targetEntity="FipeManufacturer", inversedBy="vehicles")
     * @ORM\JoinColumn(name="manufacturer_id", referencedColumnName="id")
     **/
    private $manufacturer;

    /**
     * @ORM\ManyToMany(targetEntity="FipeTable", mappedBy="years")
     **/
    private $tables;

    /**
     * @ORM\OneToMany(targetEntity="FipeVehiclePrice", mappedBy="year")
     **/
    private $prices;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inserted", type="datetime", nullable=false)
     */
    private $inserted = 'CURRENT_TIMESTAMP';

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param string $id
     * @return Vehicle
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Vehicle
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Vehicle
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set manufacturer
     *
     * @param \Syclass\FipeBundle\Entity\FipeManufacturer $manufacturer
     * @return FipeVehicle
     */
    public function setManufacturer(\Syclass\FipeBundle\Entity\FipeManufacturer $manufacturer = null)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return \Syclass\FipeBundle\Entity\FipeManufacturer
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set vehicle
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehicle $vehicle
     * @return FipeVehicleYear
     */
    public function setVehicle(\Syclass\FipeBundle\Entity\FipeVehicle $vehicle = null)
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    /**
     * Get vehicle
     *
     * @return \Syclass\FipeBundle\Entity\FipeVehicle
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prices = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add prices
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehiclePrice $prices
     * @return FipeVehicleYear
     */
    public function addPrice(\Syclass\FipeBundle\Entity\FipeVehiclePrice $prices)
    {
        $this->prices[] = $prices;

        return $this;
    }

    /**
     * Remove prices
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehiclePrice $prices
     */
    public function removePrice(\Syclass\FipeBundle\Entity\FipeVehiclePrice $prices)
    {
        $this->prices->removeElement($prices);
    }

    /**
     * Get prices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return FipeVehicleYear
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set inserted
     *
     * @param \DateTime $inserted
     * @return FipeVehicleYear
     */
    public function setInserted($inserted)
    {
        $this->inserted = $inserted;

        return $this;
    }

    /**
     * Get inserted
     *
     * @return \DateTime
     */
    public function getInserted()
    {
        return $this->inserted;
    }

    /**
     * Add table
     *
     * @param \Syclass\FipeBundle\Entity\FipeTable $table
     *
     * @return FipeVehicleYear
     */
    public function addTable(\Syclass\FipeBundle\Entity\FipeTable $table)
    {
        $this->tables[] = $table;

        return $this;
    }

    /**
     * Remove table
     *
     * @param \Syclass\FipeBundle\Entity\FipeTable $table
     */
    public function removeTable(\Syclass\FipeBundle\Entity\FipeTable $table)
    {
        $this->tables->removeElement($table);
    }

    /**
     * Get tables
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTables()
    {
        return $this->tables;
    }
}
