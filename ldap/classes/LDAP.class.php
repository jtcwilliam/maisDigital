<?php

class LDAP {
    
    const HOST    = 'ad.guarulhos.sp.gov.br';
    const PORT    = '389';
    const DOMAIN  = 'guarulhosgov';
    const BASE_DN = 'OU="Secretarias e Coordenadorias";OU="Prefeitura";DC="guarulhos";DC="sp";DC="gov";DC="br"';
            
    /** Loga o usuário e cria sessões com o nome, o usuário, o email e o perfil (departamento)
     * 
     * @param String $usuario Nome de usuário
     * @param String $senha Senha do usuário
     * @return boolean
     * @throws LDAPException
     */
    public function logar($usuario, $senha){
        $conexao = @ldap_connect(self::HOST, self::PORT);
        @ldap_set_option($conexao, LDAP_OPT_PROTOCOL_VERSION, 3);
        @ldap_set_option($conexao, LDAP_OPT_REFERRALS, 0);
        if (!@ldap_bind($conexao, self::DOMAIN."\\".$usuario, $senha)){
            throw new LDAPException("Usuário e/ou senha inválidos.");
        }
        $filtro = "(&(objectClass=user)(objectCategory=person)(samaccountname=$usuario))";
        $campos = array("displayname","samaccountname", "userprincipalname","distinguishedname", );
        if (!($busca = @ldap_search($conexao, self::BASE_DN, $filtro, $campos))){
            throw new LDAPException(ldap_error($conexao));
        }
        if (!($info = @ldap_get_entries($conexao, $busca))){
            throw new LDAPException(ldap_error($conexao));
        }
        return $info;
    }
	
}

class LDAPException extends Exception {
	
}