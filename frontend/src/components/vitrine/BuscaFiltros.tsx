'use client'

import { useState } from 'react'
import { useRouter, useSearchParams } from 'next/navigation'
import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'
import { Search } from 'lucide-react'

export default function BuscaFiltros() {
  const router = useRouter()
  const searchParams = useSearchParams()
  const [busca, setBusca] = useState(searchParams.get('q') ?? '')
  const [cidade, setCidade] = useState(searchParams.get('cidade') ?? '')

  function handleBuscar() {
    const params = new URLSearchParams()
    if (busca) params.set('q', busca)
    if (cidade) params.set('cidade', cidade)
    router.push(`/?${params.toString()}`)
  }

  return (
    <div className="flex flex-col sm:flex-row gap-3 max-w-2xl mx-auto">
      <Input
        placeholder="Buscar serviço... ex: cabeleireiro, eletricista"
        value={busca}
        onChange={(e) => setBusca(e.target.value)}
        onKeyDown={(e) => e.key === 'Enter' && handleBuscar()}
        className="flex-1"
      />
      <Input
        placeholder="Cidade"
        value={cidade}
        onChange={(e) => setCidade(e.target.value)}
        onKeyDown={(e) => e.key === 'Enter' && handleBuscar()}
        className="sm:w-40"
      />
      <Button onClick={handleBuscar}>
        <Search className="w-4 h-4 mr-2" />
        Buscar
      </Button>
    </div>
  )
}