<?

use PHPUnit\Framework\TestCase;
use Akihisa1210\Oyaoya\Example;

class ExampleTest extends TestCase
{
    public function testAdd()
    {
        $example = new Example();
        $this->assertEquals(3, $example->add(1, 2));
    }
}
