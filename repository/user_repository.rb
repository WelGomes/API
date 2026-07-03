require_relative "../config/connect"
require 'bcrypt'

class UserRepository < Connect
  
  def initialize()
    super()
  end

  def create(user)

    stmt = @connect.prepare("INSERT INTO user (name, email, cpf, password, status, type_user) VALUES (?, ?, ?, ?, ?, ?)")
    stmt.execute(user.name, user.email, user.cpf, BCrypt::Password.create(user.password), user.status, user.type_user)

  end

  def find_by_email(user)
    
    stmt   = @connect.prepare("SELECT email, password FROM user WHERE email = ?")
    result = stmt.execute(user.email)

    if result.first.nil?
      return false
    end

    unless BCrypt::Password.new(result.first["password"]) == user.password
      return false
    end

    return user

  end

end