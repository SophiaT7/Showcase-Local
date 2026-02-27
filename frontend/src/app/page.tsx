import { Suspense } from 'react'
import BuscaFiltros from '@/components/vitrine/BuscaFiltros'
import ListaVitrines from '@/components/vitrine/ListaVitrines'

export default function Home() {
  return (
    <main className="min-h-screen bg-gray-50">
      {/* Hero */}
      <section className="bg-white border-b">
        <div className="max-w-5xl mx-auto px-4 py-16 text-center">
          <h1 className="text-4xl font-bold text-gray-900 mb-4">
            Encontre serviços perto de você
          </h1>
          <p className="text-gray-500 text-lg mb-8">
            Descubra microempreendedores locais e veja o que eles oferecem
          </p>
          <BuscaFiltros />
        </div>
      </section>

      {/* Lista */}
      <section className="max-w-5xl mx-auto px-4 py-12">
        <Suspense fallback={<p>Carregando...</p>}>
          <ListaVitrines />
        </Suspense>
      </section>
    </main>
  )
}