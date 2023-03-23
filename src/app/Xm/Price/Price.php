<?php

namespace App\Xm\Price;

use Carbon\Carbon;

class Price
{
    private ?int $date;
    private ?float $open;
    private ?float $high;
    private ?float $low;
    private ?float $close;
    private ?int $volume;

    /**
     * @param int|null $date
     * @param float|null $open
     * @param float|null $high
     * @param float|null $low
     * @param float|null $close
     * @param int|null $volume
     */
    public function __construct(?int $date, ?float $open, ?float $high, ?float $low, ?float $close, ?int $volume)
    {
        $this->date = $date;
        $this->open = $open;
        $this->high = $high;
        $this->low = $low;
        $this->close = $close;
        $this->volume = $volume;
    }

    /**
     * @return int|null
     */
    public function getDate(): ?int
    {
        return $this->date;
    }

    /**
     * @return float|null
     */
    public function getOpen(): ?float
    {
        return $this->open;
    }

    /**
     * @return float|null
     */
    public function getHigh(): ?float
    {
        return $this->high;
    }

    /**
     * @return float|null
     */
    public function getLow(): ?float
    {
        return $this->low;
    }

    /**
     * @return float|null
     */
    public function getClose(): ?float
    {
        return $this->close;
    }

    /**
     * @return int|null
     */
    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function getDateFormatted(): ?string
    {
        return Carbon::createFromTimestamp($this->date)->toDateString();
    }
}
