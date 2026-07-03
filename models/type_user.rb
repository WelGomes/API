module TypeUser 
  
  USER  = "USER"
  ADMIN = "ADMIN"

  def self.type_user(type_user:)
    
    case type_user
      
    when "user"
      return USER

    when "admin"
      return ADMIN

    else
      return USER
    
    end

  end

end