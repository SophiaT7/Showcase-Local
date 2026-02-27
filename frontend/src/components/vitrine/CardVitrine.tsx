import Link from 'next/link'
import { Vitrine } from '@/types'
import { Badge } from '@/components/ui/badge'
import { MapPin, Star } from 'lucide-react'

interface Props {
  vitrine: Vitrine
}

export default function CardVitrine({ vitrine }: Props) {
  return (
    <Link href={`/vitrine/${vitrine.slug}`}>
      <div className="bg-white rounded-xl border hover:shadow-md transition-shadow overflow-hidden cursor-pointer">
        {/* Banner */}
        <div
          className="h-24 w-full"
          style={{ backgroundColor: vitrine.cor_primaria }}
        >
          {vitrine.banner && (
            <img src={vitrine.banner} alt="" className="w-full h-full object-cover" />
          )}
        </div>

        <div className="p-4">
          {/* Avatar + Nome */}
          <div className="flex items-center gap-3 -mt-8 mb-3">
            <div className="w-14 h-14 rounded-full border-2 border-white bg-gray-200 overflow-hidden">
              {vitrine.foto_perfil ? (
                <img src={vitrine.foto_perfil} alt={vitrine.nome} className="w-full h-full object-cover" />
              ) : (
                <div className="w-full h-full flex items-center justify-center text-xl font-bold text-gray-400">
                  {vitrine.nome[0]}
                </div>
              )}
            </div>
          </div>

          <h3 className="font-semibold text-gray-900">{vitrine.nome}</h3>

          {vitrine.categoria && (
            <Badge variant="secondary" className="mt-1 mb-2">{vitrine.categoria.nome}</Badge>
          )}

          <p className="text-sm text-gray-500 line-clamp-2">{vitrine.descricao}</p>

          <div className="flex items-center justify-between mt-3 text-xs text-gray-400">
            <span className="flex items-center gap-1">
              <MapPin className="w-3 h-3" />
              {vitrine.cidade} - {vitrine.estado}
            </span>
            {vitrine.media_avaliacoes > 0 && (
              <span className="flex items-center gap-1">
                <Star className="w-3 h-3 text-yellow-400 fill-yellow-400" />
                {vitrine.media_avaliacoes.toFixed(1)}
              </span>
            )}
          </div>
        </div>
      </div>
    </Link>
  )
}