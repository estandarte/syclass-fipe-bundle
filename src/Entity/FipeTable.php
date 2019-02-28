<?php

namespace Syclass\FipeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class FipeTable
{
    private $id;
    private $description;
    private $slug;
    private $manufacturer_update;
    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return FipeTable
     */
    public function setSlug($slug)
    {
        $this->slug = preg_replace('/[^0-9A-Za-z._]/', '-', $slug);

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

    private $manufacturers;
    private $vehicles;
    private $years;
    private $prices;

    /**
     * @var \DateTime
     *
     */
    private $month;

    /**
     * @var \DateTime
     *
     */
    private $updated;

    /**
     * @var \DateTime
     *
     */
    private $inserted;

    /**
     * @var \DateTime
     *
     */
    private $checked;

    public function __construct() {
        $this->manufacturers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return FipeTable
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return FipeTable
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Add manufacturers
     *
     * @param \Syclass\FipeBundle\Entity\FipeManufacturer $manufacturers
     * @return FipeTable
     */
    public function addManufacturer(\Syclass\FipeBundle\Entity\FipeManufacturer $manufacturers)
    {
        $this->manufacturers[] = $manufacturers;

        return $this;
    }

    /**
     * Remove manufacturers
     *
     * @param \Syclass\FipeBundle\Entity\FipeManufacturer $manufacturers
     */
    public function removeManufacturer(\Syclass\FipeBundle\Entity\FipeManufacturer $manufacturers)
    {
        $this->manufacturers->removeElement($manufacturers);
    }

    /**
     * Get manufacturers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getManufacturers()
    {
        return $this->manufacturers;
    }

    /**
     * Add vehicles
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehicle $vehicles
     * @return FipeTable
     */
    public function addVehicle(\Syclass\FipeBundle\Entity\FipeVehicle $vehicles)
    {
        $this->vehicles[] = $vehicles;

        return $this;
    }

    /**
     * Remove vehicles
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehicle $vehicles
     */
    public function removeVehicle(\Syclass\FipeBundle\Entity\FipeVehicle $vehicles)
    {
        $this->vehicles->removeElement($vehicles);
    }

    /**
     * Get vehicles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVehicles()
    {
        return $this->vehicles;
    }

    /**
     * Add prices
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehicleYear $prices
     * @return FipeTable
     */
    public function addPrice(\Syclass\FipeBundle\Entity\FipeVehicleYear $prices)
    {
        $this->prices[] = $prices;

        return $this;
    }

    /**
     * Remove prices
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehicleYear $prices
     */
    public function removePrice(\Syclass\FipeBundle\Entity\FipeVehicleYear $prices)
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
     * @return FipeTable
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
     * @return FipeTable
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
     * Set checked
     *
     * @param \DateTime $checked
     * @return FipeTable
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * Get checked
     *
     * @return \DateTime
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * Set month
     *
     * @param \DateTime $month
     * @return FipeTable
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month
     *
     * @return \DateTime
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Add year
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehicleYear $year
     *
     * @return FipeTable
     */
    public function addYear(\Syclass\FipeBundle\Entity\FipeVehicleYear $year)
    {
        $this->years[] = $year;

        return $this;
    }

    /**
     * Remove year
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehicleYear $year
     */
    public function removeYear(\Syclass\FipeBundle\Entity\FipeVehicleYear $year)
    {
        $this->years->removeElement($year);
    }

    /**
     * Get years
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getYears()
    {
        return $this->years;
    }
}
