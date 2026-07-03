require "json"
require_relative "../service/user_service"

class RegisterController
  
  def initialize()
    @user_service = UserService.new()
  end

  def index(request, response)
   
    begin
      
      json      = JSON.parse(request.body)
      name      = json["name"]
      email     = json["email"]
      cpf       = json["cpf"]
      password  = json["password"].to_s
      status    = json["status"]
      type_user = json["type_user"]

      @user_service.create(name, email, cpf, password, status, type_user)

      response.body = {
        message: "Usuário cadastrado com sucesso",
        status_code: 200
      }.to_json

    rescue => error

      response.body = {
        message: error.message(),
        status_code: 400
      }.to_json

    end

  end  

end