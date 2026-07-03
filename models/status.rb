module Status
  
  ATIVO   = true
  INATIVO = false

  def self.status(status:)

    case status

      when "true"
        return ATIVO

      when "false"
        return INATIVO
      
      else
        return INATIVO

    end

  end

end