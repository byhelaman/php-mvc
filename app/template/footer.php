<?php

namespace App\Template;

class Footer
{
  public function __toString()
  {
    return $this->showFooter();
  }

  public function showFooter()
  {
    return ("

      </body>
      </html>

    ");
  }
}
