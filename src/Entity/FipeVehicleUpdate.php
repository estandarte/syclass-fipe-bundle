<?php

namespace Syclass\FipeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Manufacturer Updates
 *
 * @ORM\Table(name="fipe_vehicle_update")
 * @ORM\Entity()
 */
class FipeVehicleUpdate
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=40, nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="FipeTable", inversedBy="vehicle_updates")
     * @ORM\JoinColumn(name="table_id", referencedColumnName="id")
     **/
    private $table;

    /**
     * @ORM\ManyToOne(targetEntity="FipeVehicle", inversedBy="updates")
     * @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id")
     **/
    private $vehicle;

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
     * @return FipeManufacturerUpdate
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
     * Set updated
     *
     * @param \DateTime $updated
     * @return FipeManufacturerUpdate
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
     * @return FipeManufacturerUpdate
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
     * Set table
     *
     * @param \Syclass\FipeBundle\Entity\FipeTable $table
     * @return FipeManufacturerUpdate
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
     * Set vehicle
     *
     * @param \Syclass\FipeBundle\Entity\FipeVehicle $vehicle
     * @return FipeVehicleUpdate
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
}
