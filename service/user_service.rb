require_relative "../models/type_user"
require_relative "../models/status"
require_relative "../models/user"
require_relative "../repository/user_repository"

class UserService
  
  def initialize()
    
    @user_repository = UserRepository.new()

  end

  def create(name, email, cpf, password, status, type_user)

    if [name, email, cpf, password].any? { |value| value.nil? || value.to_s.empty? }
      raise "Preencha todos os dados corretamente!"  
    end

    unless email =~ URI::MailTo::EMAIL_REGEXP
      raise "E-mail inválido"
    end

    status    = Status.status(status: status.downcase())
    type_user = TypeUser.type_user(type_user: type_user.downcase())
    user      = User.new(name: name, email: email, cpf: cpf, password: password, status: status, type_user: type_user)

    if @user_repository.find_by_email(user)
      raise "E-mail já cadastrado"
    end

    @user_repository.create(user)

  end

  def list(email, password)

    if [email, password].any? { |value| value.nil? || value.empty? }
      raise "Preencha todos os campos!"
    end

    user = User.new(email: email, password: password)

    unless @user_repository.find_by_email(user)
      raise "Usuário ou senha incorreto!"
    end

  end

end