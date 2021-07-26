<?php

namespace Model;

class BaseModel
{
    public function listeProprietes()
    {
        return get_object_vars($this);
    }
}
