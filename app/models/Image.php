<?php

require_once 'Models.php';

class Image{
  private int $id;
  private string $name;
  private string $path;

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
   * @return self
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
   * Get the value of path
   * 
   * @return string
   */ 
  public function getPath(): string
  {
    return $this->path;
  }

  /**
   * Set the value of path
   *
   * @param string $path
   * @return  self
   */ 
  public function setPath(string $path): self
  {
    $this->path = $path;
    return $this;
  }
}