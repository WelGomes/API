require_relative "../service/user_service"

class LoginController
  
  def initialize()
    @user_service = UserService.new()
  end

  def index(request, response)
    
    begin

      body     = JSON.parse(request.body)
      email    = body["email"]
      password = body["password"].to_s

      @user_service.list(email, password)

      response.body = {
        message: "Login efetuado com sucesso",
        status_code: 200,
    }.to_json

    rescue => error

      response.body = {
        message: error.message(),
        status_code: 400,
      }.to_json

    end

  end

end