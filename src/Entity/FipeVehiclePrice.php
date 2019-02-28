<?php

namespace Syclass\FipeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicle Year
 *
 * @ORM\Table(name="fipe_vehicle_price")
 * @ORM\Entity(repositoryClass="Syclass\FipeBundle\Repository\FipeVehiclePriceRepository")
 */
class FipeVehiclePrice
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=40, nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="FipeTable", inversedBy="prices")
     * @ORM\JoinColumn(name="table_id", referencedColumnName="id")
     **/
    private $table;

    /**
     * @var decimal
     *
     * @ORM\Column(name="price", type="decimal", nullable=false, scale=2)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=60, nullable=false)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="FipeVehicle", inversedBy="prices")
     * @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id")
     **/
    private $vehicle;

    /**
     * @ORM\ManyToOne(targetEntity="FipeManufacturer", inversedBy="vehicles")
     * @ORM\JoinColumn(name="manufacturer_id", referencedColumnName="id")
     **/
    private $manufacturer;

    /**
     * @ORM\ManyToOne(targetEntity="FipeVehicleYear", inversedBy="prices")
     * @ORM\JoinColumn(name="year_id", referencedColumnName="id")
     **/
    private $year;
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
     * Set id
     *
     * @param string $id
     * @return FipeVehiclePrice
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set slug
     *
     * @param string $slug
     * @return FipeVehiclePrice
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
     * Set updated
     *
     * @param \DateTime $updated
     * @return FipeVehiclePrice
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
     * Set vehicle
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehicle $vehicle
     * @return FipeVehiclePrice
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
     * Set manufacturer
     *
     * @param \Syclass\FipeBundle\Entity\FipeManufacturer $manufacturer
     * @return FipeVehiclePrice
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
     * Set year
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehicleYear $year
     * @return FipeVehiclePrice
     */
    public function setYear(\Syclass\FipeBundle\Entity\FipeVehicleYear $year = null)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return \Syclass\FipeBundle\Entity\FipeVehicleYear
     */
    public function getYear()
    {
        return $this->year;
    }


    /**
     * Set table
     *
     * @param \Syclass\FipeBundle\Entity\FipeTable $table
     * @return FipeVehiclePrice
     */
    public function setTable(\Syclass\FipeBundle\Entity\FipeTable $table = null)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Get table
     *
     * @return \Syclass\FipeBundle\Entity\FipeTable
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return FipeVehiclePrice
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set inserted
     *
     * @param \DateTime $inserted
     * @return FipeVehiclePrice
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
}
