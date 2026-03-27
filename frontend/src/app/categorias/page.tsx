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

  return (
    <div className="max-w-4xl mx-auto px-4 py-12">
      <h1 className="text-3xl font-bold text-gray-900 mb-2">Categorias</h1>
      <p className="text-gray-500 mb-8">Explore serviços por categoria</p>

      <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        {categorias.map(cat => (
          <Link
            key={cat.id}
            href={`/?categoria=${cat.slug}`}
            className="bg-white border rounded-xl p-5 text-center hover:shadow-md hover:border-indigo-300 transition-all flex flex-col items-center gap-2"
          >
            {cat.icone && (
              <LucideIcon name={cat.icone} size={32} className="text-indigo-600" />
            )}
            <p className="font-semibold text-gray-800">{cat.nome}</p>
          </Link>
        ))}
      </div>
    </div>
  )
}
