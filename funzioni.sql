-- --------------------------------------------------------------------------------
-- Routine DDL
-- Note: comments before and after the routine body will not be stored by the server
-- --------------------------------------------------------------------------------
DELIMITER $$

CREATE DEFINER=`root`@`localhost` FUNCTION `stripSpeciaChars`(`dirty_string` longtext) RETURNS longtext CHARSET utf8
BEGIN
          DECLARE allow_space INT DEFAULT 1;
          DECLARE allow_number INT DEFAULT 0;
          DECLARE allow_alphabets INT DEFAULT 1;
          DECLARE no_trim INT DEFAULT 1;          
          DECLARE clean_string longtext DEFAULT '';
          DECLARE c VARCHAR(2048) DEFAULT '';
          DECLARE counter INT DEFAULT 1;
	  
	  DECLARE has_space TINYINT DEFAULT 0; -- let spaces in result string
	  DECLARE chk_cse TINYINT DEFAULT 0; 
	  DECLARE adv_trim TINYINT DEFAULT 1; -- trim extra spaces along with hidden characters, new line characters etc.	  
	
          IF dirty_string IS NULL THEN
             RETURN clean_string;
          END IF;   	  
	  
	  if allow_number=0 and allow_alphabets=0 then
	    	RETURN clean_string;
	  elseif allow_number=1 and allow_alphabets=0 then
	  	set chk_cse =1;
	  elseif allow_number=0 and allow_alphabets=1 then
	  	set chk_cse =2;
	  end if;	  
	  
	  if allow_space=1 then
	  	set has_space =1;
	  end if;
	  
	  if no_trim=1 then
	  	set adv_trim =0;
	  end if;
      IF ISNULL(dirty_string) THEN
          RETURN NULL;
      ELSE
	  
	  CASE chk_cse
	      WHEN 1 THEN 
		  -- return only Numbers in result
		  WHILE counter <= LENGTH(dirty_string) DO
		           
		          SET c = MID(dirty_string, counter, 1);
		          IF ASCII(c) = 32 OR ASCII(c) >= 48 AND ASCII(c) <= 57  THEN
		                SET clean_string = CONCAT(clean_string, c);
		          END IF;
		          SET counter = counter + 1;
		    END WHILE;
	      WHEN 2 THEN 
		  -- return only Alphabets in result
		  WHILE counter <= LENGTH(dirty_string) DO
		           
		          SET c = MID(dirty_string, counter, 1);
		          IF ASCII(c) = 32 OR (ASCII(c) >= 65 AND ASCII(c) <= 90) OR (ASCII(c) >= 97 AND ASCII(c) <= 122)
				OR ASCII(c) = 192 OR ASCII(c) = 193 OR ASCII(c) = 200 OR ASCII(c) = 201 OR ASCII(c) = 204 OR ASCII(c) = 205
	  			OR ASCII(c) = 210 OR ASCII(c) = 211 OR ASCII(c) = 217 OR ASCII(c) = 218 OR ASCII(c) = 224 OR ASCII(c) = 225
				OR ASCII(c) = 232 OR ASCII(c) = 233 OR ASCII(c) = 236 OR ASCII(c) = 237 OR ASCII(c) = 242 OR ASCII(c) = 243
				OR ASCII(c) = 249 OR ASCII(c) = 250
				THEN
		                SET clean_string = CONCAT(clean_string, c);
		          END IF;
		          SET counter = counter + 1;
		    END WHILE;
	      ELSE
		   -- return numbers and Alphabets in result
		   WHILE counter <= LENGTH(dirty_string) DO
		           
		          SET c = MID(dirty_string, counter, 1);
		          IF ASCII(c) = 32 OR (ASCII(c) >= 48 AND ASCII(c) <= 57) OR (ASCII(c) >= 65 AND ASCII(c) <= 90)  OR (ASCII(c) >= 97 AND ASCII(c) <= 122) 
			 	OR ASCII(c) = 192 OR ASCII(c) = 193 OR ASCII(c) = 200 OR ASCII(c) = 201 OR ASCII(c) = 204 OR ASCII(c) = 205
	  			OR ASCII(c) = 210 OR ASCII(c) = 211 OR ASCII(c) = 217 OR ASCII(c) = 218 OR ASCII(c) = 224 OR ASCII(c) = 225
				OR ASCII(c) = 232 OR ASCII(c) = 233 OR ASCII(c) = 236 OR ASCII(c) = 237 OR ASCII(c) = 242 OR ASCII(c) = 243
				OR ASCII(c) = 249 OR ASCII(c) = 250
			  THEN
		                SET clean_string = CONCAT(clean_string, c);
		          END IF;
		          SET counter = counter + 1;
		    END WHILE;		
	    END CASE;            
      END IF;
	 
	  -- remove spaces from result
	  if has_space=0 then
	  SET clean_string =REPLACE(clean_string,' ','');
	  end if;
	 
	   -- remove extra spaces, newline,tabs. from result
	 if adv_trim=1 then
	  SET clean_string =TRIM(Replace(Replace(Replace(clean_string,'\t',''),'\n',''),'\r',''));
	  end if;	
	   -- replace caratteri accentati con normali 
	   -- SET clean_string =REPLACE(clean_string,'À','A');
	   -- SET clean_string =REPLACE(clean_string,'Á','A');  
	   -- SET clean_string =REPLACE(clean_string,'È','E');  
	   -- SET clean_string =REPLACE(clean_string,'É','E');  
	   -- SET clean_string =REPLACE(clean_string,'Ì','I');  
	   -- SET clean_string =REPLACE(clean_string,'Í','I');  
	   -- SET clean_string =REPLACE(clean_string,'Ò','O');  
	   -- SET clean_string =REPLACE(clean_string,'Ó','O');  
	   -- SET clean_string =REPLACE(clean_string,'Ù','U');  
	   -- SET clean_string =REPLACE(clean_string,'Ú','U');  
	   -- SET clean_string =REPLACE(clean_string,'à','a');  
	   -- SET clean_string =REPLACE(clean_string,'á','a');  
	   -- SET clean_string =REPLACE(clean_string,'è','e');  
	   -- SET clean_string =REPLACE(clean_string,'é','e');  
	   -- SET clean_string =REPLACE(clean_string,'ì','i');  
	   -- SET clean_string =REPLACE(clean_string,'í','i');  
	   -- SET clean_string =REPLACE(clean_string,'ò','o');  
	   -- SET clean_string =REPLACE(clean_string,'ó','o');  
	   -- SET clean_string =REPLACE(clean_string,'ù','u');  
	   -- SET clean_string =REPLACE(clean_string,'ú','u');  
			
      RETURN clean_string;
END
