<?php

require_once 'Models.php';

class Type{
  private int $id;
  private string $name;
  private string $color;
  
  use Model1;

  // Getters et setters
  /**
   * Get the value of id
   * 
   * @return int
   */ 
  public function getId(): int
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @param int $id
   * @return  self
   */ 
  public function setId(int $id): self
  {
    $this->id = $id;
    return $this;
  }

  /**
   * Get the value of name
   * 
   * @return string
   */ 
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * Set the value of name
   *
   * @param string $name
   * @return  self
   */ 
  public function setName(string $name): self
  {
    $this->name = $name;
    return $this;
  }

  /**
   * Get the value of color
   * 
   * @return string
   */ 
  public function getColor(): string
  {
    return $this->color;
  }

  /**
   * Set the value of color
   *
   * @param string $color
   * @return  self
   */ 
  public function setColor(string $color): self
  {
    $this->color = $color;
    return $this;
  }
}