import { notFound } from 'next/navigation'
import api from '@/lib/api'
import { Vitrine } from '@/types'
import { MapPin, Phone, Star, Clock, Image as ImageIcon } from 'lucide-react'
import { Badge } from '@/components/ui/badge'

const DIAS = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb']

async function getVitrine(slug: string): Promise<Vitrine | null> {
  try {
        console.log('URL chamada:', `/vitrines/${slug}`)
    const { data } = await api.get(`/vitrines/${slug}`)
    return data
  } catch (error: any) {
    console.error('API Error:', error?.response?.status, error?.message)
    return null
  }
}

export default async function VitrinePage({ params }: { params: Promise<{ slug: string }> }) {
  const { slug } = await params
  const vitrine = await getVitrine(slug)
  if (!vitrine) notFound()

  const whatsappUrl = `https://wa.me/55${vitrine.whatsapp.replace(/\D/g, '')}`

  return (
    <div className="max-w-4xl mx-auto px-4 py-8">

      {/* Banner + Perfil */}
      <div className="rounded-2xl border bg-white shadow-sm mb-6">
        <div
          className="h-40 w-full rounded-t-2xl relative overflow-hidden"
          style={{ backgroundColor: vitrine.cor_primaria ?? '#6366f1' }}
        >
          {vitrine.banner && (
            <img src={vitrine.banner_url} alt="" className="w-full h-full object-cover" />
          )}
        </div>
        <div className="px-6 pb-6 pt-3">
          <div className="flex gap-4 mb-4">
            <div className="w-20 h-20 rounded-2xl border-4 border-white bg-gray-100 overflow-hidden shadow shrink-0 ">
              {vitrine.foto_perfil ? (
                <img src={vitrine.foto_perfil_url} alt={vitrine.nome} className="w-full h-full object-cover" />
              ) : (
                <div className="w-full h-full flex items-center justify-center text-3xl font-bold text-gray-400">
                  {vitrine.nome[0]}
                </div>
              )}
            </div>
            <div className="pb-2">
              <h1 className="text-2xl font-bold text-gray-900">{vitrine.nome}</h1>
              <div className="flex items-center gap-2 mt-1 flex-wrap">
                {vitrine.categoria && (
                  <Badge variant="secondary">{vitrine.categoria.nome}</Badge>
                )}
                <span className="flex items-center gap-1 text-sm text-gray-500">
                  <MapPin className="w-3 h-3" />
                  {vitrine.cidade}{vitrine.bairro ? `, ${vitrine.bairro}` : ''} — {vitrine.estado}
                </span>
                {vitrine.media_avaliacoes > 0 && (
                  <span className="flex items-center gap-1 text-sm text-yellow-500 font-medium">
                    <Star className="w-3 h-3 fill-yellow-400" />
                    {vitrine.media_avaliacoes.toFixed(1)}
                    <span className="text-gray-400 font-normal">({vitrine.total_avaliacoes})</span>
                  </span>
                )}
              </div>
            </div>
          </div>

          {vitrine.descricao && (
            <p className="text-gray-600 text-sm leading-relaxed mb-4">{vitrine.descricao}</p>
          )}

          <a
            href={whatsappUrl}
            target="_blank"
            rel="noopener noreferrer"
            className="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-5 py-2.5 rounded-xl transition-colors text-sm"
          >
            <Phone className="w-4 h-4" />
            Falar no WhatsApp
          </a>
        </div>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">

        {/* Serviços */}
        {vitrine.servicos?.length > 0 && (
          <div className="md:col-span-2 bg-white rounded-2xl border shadow-sm p-6">
            <h2 className="text-lg font-bold text-gray-900 mb-4">Serviços</h2>
            <div className="divide-y">
              {vitrine.servicos.map(s => (
                <div key={s.id} className="py-3 flex justify-between items-start gap-4">
                  <div>
                    <p className="font-medium text-gray-800">{s.nome}</p>
                    {s.descricao && <p className="text-sm text-gray-500 mt-0.5">{s.descricao}</p>}
                  </div>
                  {(s.preco_label || s.preco) && (
                    <span className="text-indigo-600 font-semibold text-sm whitespace-nowrap">
                      {s.preco_label ?? `R$ ${Number(s.preco).toFixed(2)}`}
                    </span>
                  )}
                </div>
              ))}
            </div>
          </div>
        )}

        {/* Horários */}
        {vitrine.horarios?.length > 0 && (
          <div className="bg-white rounded-2xl border shadow-sm p-6">
            <h2 className="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
              <Clock className="w-4 h-4 text-indigo-500" /> Horários
            </h2>
            <div className="space-y-2 text-sm">
              {vitrine.horarios.map(h => (
                <div key={h.id} className="flex justify-between">
                  <span className="text-gray-500">{DIAS[h.dia_semana]}</span>
                  <span className={h.fechado ? 'text-red-400' : 'text-gray-700 font-medium'}>
                    {h.fechado ? 'Fechado' : `${h.abertura} – ${h.fechamento}`}
                  </span>
                </div>
              ))}
            </div>
          </div>
        )}
      </div>

      {/* Galeria */}
      {vitrine.galeria?.length > 0 && (
        <div className="mt-6 bg-white rounded-2xl border shadow-sm p-6">
          <h2 className="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
            <ImageIcon className="w-4 h-4 text-indigo-500" /> Galeria
          </h2>
          <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
            {vitrine.galeria.map(foto => (
              <div key={foto.id} className="aspect-square rounded-xl overflow-hidden bg-gray-100">
                <img
                  src={foto.path}
                  alt={foto.legenda ?? ''}
                  className="w-full h-full object-cover hover:scale-105 transition-transform"
                />
              </div>
            ))}
          </div>
        </div>
      )}

      {/* Avaliações */}
      {vitrine.avaliacoes?.length > 0 && (
        <div className="mt-6 bg-white rounded-2xl border shadow-sm p-6">
          <h2 className="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
            <Star className="w-4 h-4 text-yellow-400 fill-yellow-400" />
            Avaliações
          </h2>
          <div className="space-y-4">
            {vitrine.avaliacoes.map((a: any) => (
              <div key={a.id} className="border-b pb-4 last:border-0">
                <div className="flex items-center justify-between mb-1">
                  <span className="font-medium text-gray-800">{a.nome_visitante}</span>
                  <div className="flex items-center gap-1">
                    {Array.from({ length: 5 }).map((_, i) => (
                      <Star
                        key={i}
                        className={`w-3 h-3 ${i < a.nota ? 'text-yellow-400 fill-yellow-400' : 'text-gray-200 fill-gray-200'}`}
                      />
                    ))}
                  </div>
                </div>
                {a.comentario && <p className="text-sm text-gray-500">{a.comentario}</p>}
              </div>
            ))}
          </div>
        </div>
      )}

    </div>
  )
}