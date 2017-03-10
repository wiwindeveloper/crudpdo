<?php  
/**
* @author Wiwin Savitri
*/
class ClassProduct
{
	public $db;

	function __construct($connect)
	{
		$this->db = $connect;
	}

	/*
	* insert to database
	*/
	public function insert($pName,$pCategory,$pStock,$pPrice,$pDescrip)
	{
		try
		{
			$stmt = $this->db->prepare("
					INSERT INTO 
						product(
							name, 
							category, 
							stock, 
							price, 
							description
							) 
					VALUES (
							:fname,
							:fcategory,
							:fstock,
							:fprice,
							:fdescript
							)
					");
			$stmt->bindparam(":fname", $pName);
			$stmt->bindparam(":fcategory", $pCategory);
			$stmt->bindparam(":fstock", $pStock);
			$stmt->bindparam(":fprice", $pPrice);
			$stmt->bindparam(":fdescript", $pDescrip);
			$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo "Failed to insert data ".$e->getMessage();
			return false;
		}
	}

	/*
	* get all data
	*/
	public function index()
	{
		try
		{
			$stmt = $this->db->prepare("
					SELECT 
						* 
					FROM 
                        product 
                    ORDER BY 
                       	id 
                    ASC
                    ");
			$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo "Failed to get the data ".$e->getMessage();
			return false;
		}
	}

	/*
	* get id 
	*/
	public function getId($id)
	{
		try
		{
			$stmt = $this->db->prepare("
					SELECT 
						* 
					FROM 
						product 
					WHERE 
						id = :id
					");
			$stmt->execute(array(":id"=>$id));
			$idRow = $stmt->fetch(PDO::FETCH_ASSOC);
			return $idRow;
		}
		catch(PDOException $e)
		{
			echo "Failed to get the id ".$e->getMessage();
			return false;
		}
	}

	/*
	* update by id
	*/
	public function update($id,$pName,$pCat,$pStock,$pPrice,$pDesc)
	{
		try
		{
			$stmt = $this->db->prepare("
					UPDATE 
						product 
					SET 
						name 	 	= :fname,
						category 	= :fcategory,
						stock 	 	= :fstock,
						price 	 	= :fprice,
						description = :fdescript 
					WHERE 
						id 			= :id
					");
			$stmt->bindparam(":fname", $pName);
			$stmt->bindparam(":fcategory", $pCat);
			$stmt->bindparam(":fstock", $pStock);
			$stmt->bindparam(":fprice", $pPrice);
			$stmt->bindparam(":fdescript", $pDesc);
			$stmt->bindparam(":id", $id);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo "Failed to update data ".$e->getMessage();
			return false;
		}
	}

	/*
	* delete data by id
	*/
	public function destroy($id)
	{
		try
		{
			$stmt = $this->db->prepare("
					DELETE FROM 
						product 
					WHERE 
						id = :id
					");
			$stmt->bindparam(":id", $id);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo "Failed to delete data ".$e->getMessage();
			return false;
		}
	}
}
?>