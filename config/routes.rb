require_relative "../controller/register_controller"
require_relative "../controller/login_controller"

class Routes < WEBrick::HTTPServlet::AbstractServlet
  
  def do_GET(request, response)
    
  end

  def do_POST(request, response)
    
    case request.path

      when "/register"
        RegisterController.new()
                          .index(request, response)

      when "/login"
        LoginController.new()
                       .index(request, response)
        
    end
    
  end

  def do_PATH(request, response)
    
  end

  def do_PUT(request, response)
    
  end

end