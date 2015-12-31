<?php namespace KEIII\SilexSitemap;

/**
 * Sitemap Item.
 */
class SitemapItem
{
    /**
     * URL of the page. This value must be less than 2,048 characters.
     * @var string
     */
    private $loc;

    /**
     * The priority of this URL relative to other URLs on your site. Valid values range from 0.0 to 1.0.
     * @var float
     */
    private $priority;

    /**
     * How frequently the page is likely to change. Valid values are always, hourly, daily, weekly, monthly, yearly and never.
     * @var string
     */
    private $changefreq;

    /**
     * The date of last modification of url. Unix timestamp or any English textual datetime description.
     * @var string|int
     */
    private $lastmod;

    /**
     * @return string
     */
    public function getLoc()
    {
        return (string)$this->loc;
    }

    /**
     * @param string $loc
     */
    public function setLoc($loc)
    {
        $this->loc = mb_substr((string)$loc, 0, 2048, 'UTF-8');
    }

    /**
     * @return float
     */
    public function getPriority()
    {
        return (float)$this->priority;
    }

    /**
     * @param float $priority
     */
    public function setPriority($priority)
    {
        if ($priority < 0 || $priority > 1) {
            $priority = 0.5;
        }

        $this->priority = (float)$priority;
    }

    /**
     * @return string
     */
    public function getChangefreq()
    {
        return (string)$this->changefreq;
    }

    /**
     * @param string $changefreq
     */
    public function setChangefreq($changefreq)
    {
        $available = array('always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never');
        $this->changefreq = in_array($changefreq, $available) ? $changefreq : $available[0];
    }

    /**
     * @return int|string
     */
    public function getLastmod()
    {
        $dt = $this->lastmod instanceof \DateTime ? $this->lastmod : new \DateTime();

        return $dt->format('Y-m-d');
    }

    /**
     * @param \DateTime $lastmod
     */
    public function setLastmod(\DateTime $lastmod)
    {
        $this->lastmod = $lastmod;
    }
}
