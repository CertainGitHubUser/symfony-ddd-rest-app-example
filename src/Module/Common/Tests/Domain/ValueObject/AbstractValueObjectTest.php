<?php


namespace App\Module\Common\Tests\Domain\ValueObject;

use App\Module\Common\Domain\ValueObject\AbstractValueObject;
use PHPUnit\Framework\TestCase;

final class AbstractValueObjectTest extends TestCase
{
    public function test_should_not_equal_to_another_vaule_object_when_class_is_different(): void
    {
        // given
        $value = 5;

        // when
        $a = new FakeValueObjectOne($value);
        $b = new FakeValueObjectTwo($value);

        $this->assertNotSame(get_class($a), get_class($b), "both objects must be of different classes");

        // then
        $this->assertFalse($a->equals($b));
        $this->assertFalse($b->equals($a));
    }

    public function test_should_not_equal_to_another_vaule_object_when_value_is_different(): void
    {
        // given
        $value = 5;

        // when
        $a = new FakeValueObjectOne($value);
        $b = new FakeValueObjectOne($value + 1);

        $this->assertSame(get_class($a), get_class($b), "both objects must be of the same class");

        // then
        $this->assertFalse($a->equals($b));
        $this->assertFalse($b->equals($a));
    }

    public function test_both_value_objects_should_be_equal(): void
    {
        // given
        $value = 5;

        // when
        $a = new FakeValueObjectOne($value);
        $b = new FakeValueObjectOne($value);

        $this->assertSame(get_class($a), get_class($b), "both objects must be of the same class");

        // then
        $this->assertTrue($a->equals($b));
        $this->assertTrue($b->equals($a));
    }

}

class FakeValueObjectOne extends AbstractValueObject
{

    protected function initialConversion($value)
    {
        return $value;
    }

    protected function validate($value): void
    {
        // no action
    }
}

class FakeValueObjectTwo extends AbstractValueObject
{

    protected function initialConversion($value)
    {
        return $value;
    }

    protected function validate($value): void
    {
        // no action
    }
}