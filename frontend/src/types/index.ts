export interface Vitrine {
  id: number
  slug: string
  nome: string
  descricao: string | null
  foto_perfil: string | null     // Legore adicionou essa linha
  foto_perfil_url: string | null
  banner: string | null          
  banner_url: string | null      // Legore adicionou essa linha
  whatsapp: string
  instagram: string | null
  cidade: string
  bairro: string | null
  estado: string
  cor_primaria: string
  status: 'pending' | 'active' | 'rejected'
  categoria: Categoria
  servicos: Servico[]
  galeria: GaleriaFoto[]
  horarios: Horario[]
  avaliacoes: any[]              // Legore adicionou essa linha
  media_avaliacoes: number
  total_avaliacoes: number
}

export interface Categoria {
  id: number
  nome: string
  slug: string
  icone: string | null
  vitrines_count?: number
}

export interface Servico {
  id: number
  nome: string
  descricao: string | null
  preco: number | null
  preco_label: string | null
  ativo: boolean
}

export interface GaleriaFoto {
  id: number
  path: string
  legenda: string | null
  ordem: number
}

export interface Horario {
  id: number
  dia_semana: number
  abertura: string | null
  fechamento: string | null
  fechado: boolean
}

export interface Avaliacao {
  id: number
  nome_visitante: string
  nota: number
  comentario: string | null
  created_at: string
}
