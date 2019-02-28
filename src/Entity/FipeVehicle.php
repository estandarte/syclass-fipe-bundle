<?php

namespace Syclass\FipeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
// use FOS\ElasticaBundle\Annotation\Search;
/**
 * Vehicle
 */
class FipeVehicle
{
    /**
     * @var string
     *
     */
    private $id;

    /**
     * @var string
     *
     */
    private $vehicle_id;

    /**
     * @var string
     *
     */
    private $name;

    /**
     * @var string
     *
     */
    private $search;

    /**
     * @var string
     *
     */
    private $slug;
    private $manufacturer;
    private $tables;
    private $years;
    private $prices;
    private $updates;

    /**
     * @var \DateTime
     */
    private $updated = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $inserted = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     */
    private $cover;

    public function __construct() {
        $this->years = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add years
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehicleYear $years
     * @return FipeVehicle
     */
    public function addYear(\Syclass\FipeBundle\Entity\FipeVehicleYear $years)
    {
        $this->years[] = $years;

        return $this;
    }

    /**
     * Remove years
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehicleYear $years
     */
    public function removeYear(\Syclass\FipeBundle\Entity\FipeVehicleYear $years)
    {
        $this->years->removeElement($years);
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

    /**
     * Set vehicle_id
     *
     * @param string $vehicleId
     * @return FipeVehicle
     */
    public function setVehicleId($vehicleId)
    {
        $this->vehicle_id = $vehicleId;

        return $this;
    }

    /**
     * Get vehicle_id
     *
     * @return string
     */
    public function getVehicleId()
    {
        return $this->vehicle_id;
    }

    /**
     * Add tables
     *
     * @param \Syclass\FipeBundle\Entity\FipeTable $tables
     * @return FipeVehicle
     */
    public function addTable(\Syclass\FipeBundle\Entity\FipeTable $tables)
    {
        $this->tables[] = $tables;

        return $this;
    }

    /**
     * Remove tables
     *
     * @param \Syclass\FipeBundle\Entity\FipeTable $tables
     */
    public function removeTable(\Syclass\FipeBundle\Entity\FipeTable $tables)
    {
        $this->tables->removeElement($tables);
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

    /**
     * Add prices
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehicleYear $prices
     * @return FipeVehicle
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
     * @return FipeVehicle
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
     * @return FipeVehicle
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
     * Add updates
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehicleUpdate $updates
     * @return FipeVehicle
     */
    public function addUpdate(\Syclass\FipeBundle\Entity\FipeVehicleUpdate $updates)
    {
        $this->updates[] = $updates;

        return $this;
    }

    /**
     * Remove updates
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehicleUpdate $updates
     */
    public function removeUpdate(\Syclass\FipeBundle\Entity\FipeVehicleUpdate $updates)
    {
        $this->updates->removeElement($updates);
    }

    /**
     * Get updates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUpdates()
    {
        return $this->updates;
    }

    /**
     * Set cover
     *
     * @param string $cover
     *
     * @return FipeVehicle
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set search
     *
     * @param string $search
     *
     * @return FipeVehicle
     */
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Get search
     *
     * @return string
     */
    public function getSearch()
    {
        return $this->search;
    }
}
