<?php


namespace Tests\Unit\ERP\Shared\Domain\ValueObjects;


use Carbon\Carbon;
use Medine\ERP\Shared\Domain\Exceptions\InvalidDateException;
use Medine\ERP\Shared\Domain\ValueObjects\DateTimeValueObject;
use Tests\TestCase;

class DateTimeValueObjectTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_return_a_date_whith_format_Ymd()
    {
        $date_time = new DateTimeValueObject();
        $date_Ymd = $date_time->createFromFormat('d/m/Y', '01/03/2021');

        $date_carbon = Carbon::createFromFormat('Y-m-d','2021-03-01' );
        $date_comparate = $date_carbon->format('Y-m-d H:s:i');

        $this->assertEquals($date_comparate, $date_Ymd->value());
    }

    /**
     * @test
     */
    public function it_should_not_return_a_date_whith_format_Ymd()
    {
        $this->expectException(InvalidDateException::class);

        $date_time = new DateTimeValueObject();
        $date_time->createFromFormat('d/m/Y', '01-03-2021');

    }
}
