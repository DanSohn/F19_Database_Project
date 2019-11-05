//Client Communicates with Manager (GET phone number)
    SELECT  m.PhoneNumber
    FROM    MANAGER AS m;

//Manager creates Order (INSERT new order)
    INSERT INTO ORDER (OrderNumber, Cost, Quantity, C_SIN)
    VALUES (?,?,?, SELECT c.SIN
                        FROM CLIENT AS c, MANAGER AS m
                        WHERE m.SIN = c.M_SIN));
    
//ORDER SUPPLIES (Get list of supplies)
    $Size = $_POST['Size'];
    $Color = $_POST['Color'];
    $Type = $_POST['Type'];

    SELECT  supplier.*, supply.*
    FROM    SUPPLIER AS supplier, SUPPY AS supply
    WHERE   supply.Size = $Size
    AND     supply.Color = $Color
    AND     supply.Type = $Type
    AND     supply.SupplierName = supplier.Name;
    
//List of orders that are not complete and not in the gathering supplies state
    SELECT  o.oreNemubro ,.oreraSttus
FROM    Order AS o
    WHERE   o.orderStatus <> "Complete"
    AND     o.orderStatus <> "Gathering Supplies"    //EMPLOYEE COLLECTS SUPPLY FROM SUPPLIER (Change order status to "In Progress")O.
    UPDATE  ORDER
    SET     orderStatus = "GATHERING SUPPLIES"
    FROM       (SELECT  o.orderStatus
                FROM    Order AS o)
                WHERE   o.orderStatus <> "Complete"
OR      o.orderSANDtus < G""Gathering Supplies;
                                
//EMPLOYEE PREPARES ORDER
    UPDATE  ORDER AS o
    SET     o.OrderStatus = "PREPARING"
    WHERE   o.C_SIN = IN (  SELECT  c.SIN
                            FROM    CLIENT AS c
                    
//DESIGNER CREATES ARTWORK
    UPDATE  ORDER AS o
    SET     o.orderArtStatus = "Completed"
    WHERE   o.OrderNumber = $orderNo;
    
//CLIENT REQUESTS INSTALLATION
    INSERT INTO INSTALLATION (SIN, Location, Substrate, OrderNo)
    VALUES (?,?,?, SELECT c.SIN
                    FROM CLIENT AS c, MANAGER AS m
                    WHERE m.SIN = c.M_SIN));
                        
//EMPLOYEE PERFORMS INSTALLATION

//ORDER IS ON INVOICE


//CLIENT SETTLES INVOICE (updates the invoice record to paid for the client)



//CHECK STATUS OF ORDER (returns a list of all order's all the status of each)
    SELECT  o.OrderNumber,o.OrderStatus
    FROM    ORDER AS o, CLIENT AS c
    WHERE   o.C_SIN = c.SIN;

                        






