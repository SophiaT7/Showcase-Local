'use client'

import { useEffect, useState } from 'react'
import { useSearchParams } from 'next/navigation'
import axios from 'axios'
import { Vitrine } from '@/types'
import CardVitrine from './CardVitrine'
import { Skeleton } from '@/components/ui/skeleton'

export default function ListaVitrines() {
  const searchParams = useSearchParams()
  const [vitrines, setVitrines] = useState<Vitrine[]>([])
  const [loading, setLoading] = useState(true)

  const qs = searchParams.toString() // string muda quando muda ?categoria=... 【1-16fce7】

  useEffect(() => {
    setLoading(true)

    // ✅ LOG seguro (agora searchParams existe)
    const url = `${process.env.NEXT_PUBLIC_API_URL}/vitrines`
    const categoria = searchParams.get('categoria')
    console.log('GET', url, { categoria })

    axios
      .get(url, {
        params: {
          q: searchParams.get('q') || undefined,
          cidade: searchParams.get('cidade') || undefined,
          categoria: categoria || undefined,
        },
      })
      .then((res) => setVitrines(res.data.data ?? res.data))
      .catch(() => setVitrines([]))
      .finally(() => setLoading(false))
  }, [qs]) // ✅ use qs (não o objeto searchParams)

  if (loading)
    return (
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        {[...Array(6)].map((_, i) => (
          <Skeleton key={i} className="h-48 rounded-xl" />
        ))}
      </div>
    )

  if (vitrines.length === 0)
    return <p className="text-center text-gray-400 py-12">Nenhum serviço encontrado.</p>

  return (
    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      {vitrines.map((v) => (
        <CardVitrine key={v.id} vitrine={v} />
      ))}
    </div>
  )
}
