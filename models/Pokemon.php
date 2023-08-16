<?php

require_once 'Models.php';

class Pokemon
{
  private int $id;
  private int $number;
  private string $name;
  private string $description;
  private int $idType1;
  private mixed $idType2;
	private mixed $idImage;

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
   * @param  int $id
   * @return  self
   */ 
  public function setId(int $id): self 
	{
    $this->id = $id;
    return $this;
  }
	
		/**
	 * Get the value of number
	 * 
	 * @return int
	 */
	public function getNumber(): int 
	{
		return $this->number;
	}
	
	/**
	 * Set the value of number
	 * 
	 * @param  int $number 
	 * @return self
	 */
	public function setNumber(int $number): self 
	{
		$this->number = $number;
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
	 * @param  string $name 
	 * @return self
	 */
	public function setName(string $name): self 
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * Get the value of description
	 * 
	 * @return string
	 */
	public function getDescription(): string 
	{
		return $this->description;
	}
	
	/**
	 * Set the value of description
	 * 
	 * @param  string $description 
	 * @return self
	 */
	public function setDescription(string $description): self 
	{
    if(is_string($description) && strlen($description) > 9 && strlen($description) < 201){
      $this->description = $description;
    }
		return $this;
	}

	/**
	 * Get the value of idType1
	 * 
	 * @return int
	 */
	public function getIdType1(): int 
	{
		return $this->idType1;
	}
	
	/**
	 * Set the value of idType1
	 * 
	 * @param  int $idType1 
	 * @return self
	 */
	public function setIdType1(int $idType1): self 
	{
		$this->idType1 = $idType1;
		return $this;
	}

	/**
	 * Get the value of idType2
	 * 
	 * @return mixed
	 */
	public function getIdType2(): mixed 
	{
		return $this->idType2;
	}
	
	/**
	 * Set the value of idType2
	 * 
	 * @param  mixed $idType2 
	 * @return self
	 */
	public function setIdType2(mixed $idType2): self 
	{
		$this->idType2 = $idType2;
		return $this;
	}

	/**
	 * Get the value of idImage
	 * 
	 * @return int
	 */ 
	public function getIdImage(): mixed
	{
		return $this->idImage;
	}

	/**
	 * Set the value of idImage
	 *
	 * @param int $idImage
	 * @return self
	 */ 
	public function setIdImage(mixed $idImage): self
	{
		$this->idImage = $idImage;
		return $this;
	}
}