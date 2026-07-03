class User 
  
  attr_accessor :id_user, :name, :email, :cpf, :password, :status, :type_user

  def initialize(id_user: nil, name: nil, cpf: nil, status: nil, type_user: nil, email:, password:)
    @id_user   = id_user
    @name      = name
    @email     = email
    @cpf       = cpf
    @password  = password
    @status    = status
    @type_user = type_user
  end

end