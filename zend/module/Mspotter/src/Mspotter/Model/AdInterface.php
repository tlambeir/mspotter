<?php
// Filename: /module/Mspotter/src/Mspotter/Model/AdInterface.php
namespace Mspotter\Model;

interface AdInterface
{
    /**
     * Will return the ID of the Mspotter ad
     *
     * @return int
     */
    public function getId();

    /**
     * Will return the TITLE of the Mspotter ad
     *
     * @return string
     */
    public function getTitle();

    /**
     * Will return the TEXT of the Mspotter ad
     *
     * @return string
     */
    public function getText();
}