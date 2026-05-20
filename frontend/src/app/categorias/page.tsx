'use client'

import { useEffect, useState } from 'react'
import api from '@/lib/api'
import { Categoria } from '@/types'
import Link from 'next/link'
import LucideIcon from '@/components/ui/LucideIcon'

export default function CategoriasPage() {
  const [categorias, setCategorias] = useState<Categoria[]>([])

  useEffect(() => {
    api.get('/categorias')
      .then(res => setCategorias(res.data))
      .catch(() => setCategorias([]))
  }, [])

  // Sort by vitrines_count descending
  const sorted = [...categorias].sort(
    (a, b) => (b.vitrines_count ?? 0) - (a.vitrines_count ?? 0)
  )

  return (
    <div className="max-w-4xl mx-auto px-4 py-12">
      <h1 className="text-3xl font-bold text-gray-900 mb-2">Categorias</h1>
      <p className="text-gray-500 mb-8">Explore serviços por categoria</p>

      <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        {sorted.map(cat => {
          const hasResults = (cat.vitrines_count ?? 0) > 0

          return (
            <Link
              key={cat.id}
              href={`/?categoria=${cat.slug}`}
              className={`group bg-white border rounded-xl p-5 text-center transition-all flex flex-col items-center gap-2 ${
                hasResults
                  ? 'hover:shadow-lg hover:border-indigo-400 hover:bg-indigo-50 hover:scale-105'
                  : 'opacity-60 grayscale'
              }`}
            >
              {cat.icone && (
                <LucideIcon
                  name={cat.icone}
                  size={32}
                  className={hasResults
                    ? 'text-indigo-600 group-hover:text-indigo-700 transition-colors'
                    : 'text-gray-400'
                  }
                />
              )}
              <p className={`font-semibold transition-colors ${
                hasResults
                  ? 'text-gray-800 group-hover:text-indigo-700'
                  : 'text-gray-400'
              }`}>
                {cat.nome}
              </p>
              <span className={`text-xs transition-colors ${
                hasResults
                  ? 'text-gray-400 group-hover:text-indigo-500'
                  : 'text-gray-300'
              }`}>
                {cat.vitrines_count ?? 0} {cat.vitrines_count === 1 ? 'resultado' : 'resultados'}
              </span>
            </Link>
          )
        })}
      </div>
    </div>
  )
}
