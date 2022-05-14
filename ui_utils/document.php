<?php
namespace de\langner_dev\ui\utils\document;

use Exception;

/**
 * Eine Klasse, die ein HTML-Element abbilden kann.
 */
abstract class HTMLElement {

    private $elements = array();
    private $attributes = array();
    private $classes = array();

    private $id, $style;

    public function __construct($classes = array(), $attributes = array())
    {
        $this->classes = $classes;
        $this->attributes = $attributes;
    }

    /**
     * Gibt nur die Starttags aus.
     */
    public abstract function printStart();
    /**
     * Gibt nur die End-Tags aus.
     */
    public abstract function printEnd();

    /**
     * Gibt den ganzen HTML-Text des Objekts aus. Dabei werden zwischen den
     * Start- und End-Tags auch die HTML-Texte der {@link #elements} ausgegeben.
     */
    public function printHTMLText() {
        $this->printStart();

        foreach ($this->elements as $e) {
            $e->printHTMLText();
        }

        $this->printEnd();
    }

    /**
     * Fügt dem Element ein neues Kind hinzu.
     */
    public function addElement(HTMLElement $element) {
        array_push($this->elements, $element);
    }

    /**
     * @return array Das Array mit allen Kinderelementen.
     */
    public function getElements(): array {
        return $this->elements;
    }

    public function setId($id) {
        $this->setAttribute("id", $id);
    }

    public function setStyle($style) {
        $this->setAttribute("style", $style);
    }

    public function setAttribute($key, $value) {
        if ($key == "class") {
            throw new Exception("Cannot set the class attribute use HTMLElement#addClass instead.");
        }

        $this->attributes[$key] = $value;
    }

    public function addClass($class_name) {
        array_push($this->classes, $class_name);
    }

    public function removeClass($class_name) {
        foreach (array_keys($this->classes) as $key) {
            if ($this->classes[$key] == $class_name) {
                unset($this->classes[$key]);
            }
        }
    }

    public function buildStartTag($tag_name) {
        echo "<$tag_name " . $this->getClassHTMLString() . " " . $this->getAttributeHTMLString() . ">";
    }
    
    private function getClassHTMLString(): string {
        $s = "";

        foreach ($this->classes as $c) {
            if ($s != "") {
                $s .= " ";
            }

            $s .= $c;
        }

        if ($c != null) {
            return "class=\"$s\"";
        }

        return $s;
    }

    private function getAttributeHTMLString(): string {
        $s = "";

        foreach (array_keys($this->attributes) as $key) {
            $value = $this->attributes[$key];

            if ($s != "") {
                $s .= " ";
            }

            $s .= "$key=\"$value\"";
        }

        return $s;
    }
}

/**
 * Ein spezielles {@link HTMLElement}, welches das Dokument aufbaut.
 */
class HTMLDocument extends HTMLElement {

    private $title;
    private $icon;

    public function __construct($title, $icon) 
    {
        $this->title = $title;
        $this->icon = $icon;   
    }
    
    public function printStart() {
        ?>
        <!doctype html>
        <html lang="en">

        <head>
            <title><?php echo ($this->title != null) ? $this->title : "Unnamed"; ?></title>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <?php
            if ($this->icon != null) {
                ?>
                <meta rel="icon" href="<?php echo $this->icon; ?>">
                <?php
            }
            ?>

            <!-- Bootstrap CSS v5.0.2 -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
                integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        </head>

        <body style="padding-top: 60px; padding-left: 5px; padding-right: 5px;">

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
            <div class="wrapper">
            
        <?php
    }

    public function printEnd() {
        ?>
        </div>
        </body>

        </html>
        <?php
    }

}
?>