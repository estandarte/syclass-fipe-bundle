<?php

namespace Syclass\FipeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Manufacturer
 *
 */
class FipeManufacturer
{
    /**
     * @var integer
     *
     */
    private $id;

    /**
     * @var string
     *
     */
    private $manufacturer;

    /**
     * @var string
     *
     */
    private $name;

    /**
     * @var string
     *
     */
    private $slug;

    /**
     * @var string
     *
     */
    private $logo;

    /**
     **/
    private $vehicles;

    /**
     **/
    private $tables;

    /**
     **/
    private $updates;

    /**
     * @var \DateTime
     *
     */
    private $updated = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     */
    private $inserted = 'CURRENT_TIMESTAMP';

    public function __construct() {
        $this->tables = new ArrayCollection();
        $this->vehicles = new ArrayCollection();
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
     * @return Manufacturer
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set manufacturer
     *
     * @param string $manufacturer
     * @return Manufacturer
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return string
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }
    /**
     * Set name
     *
     * @param string $name
     * @return Manufacturer
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
     * @return Manufacturer
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
     * Add vehicles
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehicle $vehicles
     * @return FipeManufacturer
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
     * Add tables
     *
     * @param \Syclass\FipeBundle\Entity\FipeTable $tables
     * @return FipeManufacturer
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
     * Set updated
     *
     * @param \DateTime $updated
     * @return FipeManufacturer
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
     * @return FipeManufacturer
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
     * @param \Syclass\FipeBundle\Entity\FipeManufacturerUpdate $updates
     * @return FipeManufacturer
     */
    public function addUpdate(\Syclass\FipeBundle\Entity\FipeManufacturerUpdate $updates)
    {
        $this->updates[] = $updates;

        return $this;
    }

    /**
     * Remove updates
     *
     * @param \Syclass\FipeBundle\Entity\FipeManufacturerUpdate $updates
     */
    public function removeUpdate(\Syclass\FipeBundle\Entity\FipeManufacturerUpdate $updates)
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
     * Set logo
     *
     * @param string $logo
     *
     * @return FipeManufacturer
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }
}
